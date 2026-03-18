<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->products()->with('images', 'category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(25);

        return view('pages.seller.product.list', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.seller.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('seller.produits.index') ->with('success', 'Produit ajouté avec succès');
    }

    public function edit(Product $produit)
    {
        if ($produit->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();

        return view('pages.seller.product.edit', [
            'product' => $produit,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $produit)
    {
        if ($produit->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'image|max:2048'
        ]);

        $produit->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');

                $produit->images()->create([
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('seller.produits.index')->with('success', 'Produit mis à jour');
    }

    public function deleteImage($id)
    {
        $image = ProductImage::find($id);

        if (!$image) {
            return response()->json(['success' => false]);
        }

        if ($image->product->user_id !== auth()->id()) {
            return response()->json(['success' => false]);
        }

        if (\Storage::disk('public')->exists($image->image)) {
            \Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

    public function destroy(Product $produit)
    {
        if ($produit->user_id !== auth()->id()) {
            abort(403);
        }

        foreach ($produit->images as $image) {
            if ($image->image && Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $produit->delete();

        return redirect()->route('seller.produits.index')->with('success', 'Produit supprimé');
    }

    public function show(Product $product)
    {
        return view('pages.products.show', compact('product'));
    }

    // public function purchase(Request $request, Product $product)
    // {
    //     $request->validate([
    //         'quantity' => 'required|integer|min:1|max:' . $product->stock,
    //     ]);

    //     $sale = $product->sales()->create([
    //         'user_id' => auth()->id(),
    //         'quantity' => $request->quantity,
    //         'total_price' => $product->price * $request->quantity,
    //         'status' => 'pending',
    //     ]);

    //     $product->decrement('stock', $request->quantity);

    //     return redirect()->route('products.show', $product)->with('success', 'Achat effectué avec succès !');
    // }

    public function purchase(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stock insuffisant');
        }

        return redirect()->route('products.confirm')->with([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);
    }

    public function confirm()
    {
        if (!session()->has('product_id')) {
            return redirect()->back();
        }

        $product = Product::findOrFail(session('product_id'));
        $quantity = session('quantity');
        return view('pages.products.confirm', compact('product', 'quantity'));
    }

    public function pay(Request $request)
    {
        $user = Auth::user();

        Stripe::setApiKey(config('services.stripe.secret'));

        $product = Product::findOrFail(session('product_id'));
        $quantity = session('quantity');

        if ($product->stock < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stock insuffisant'
            ]);
        }

        $total = $product->price * $quantity;
        $amountInCents = $total * 100;

        try {
            $intent = PaymentIntent::create([
                'amount' => $amountInCents,
                'currency' => 'eur',
                'payment_method' => $request->payment_method,
                'confirm' => true,
                'automatic_payment_methods' => ['enabled' => true],
            ]);

            if ($intent->status === 'succeeded') {
                $product->decrement('stock', $quantity);

                ProductSale::create([
                    'product_id' => $product->id,
                    'buyer_id'   => $user->id,
                    'seller_id'  => $product->user_id,
                    'quantity'   => $quantity,
                    'total_price'=> $total,
                ]);

                return response()->json([
                    'success' => true,
                    'redirect' => route('products.success')
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Paiement non effectué. Veuillez réessayer.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de paiement : ' . $e->getMessage()
            ]);
        }
    }

    public function sales()
    {
        $sales = ProductSale::where('seller_id', auth()->id())
                            ->with('product', 'buyer')
                            ->latest()
                            ->get();

        return view('seller.sales', compact('sales'));
    }
}