<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    // Afficher la liste
   public function index(Request $request)
    {
        $query = Subcategory::query()->with('category');

        // Filtre par recherche (nom ou description)
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtre par catégorie
        if ($categoryId = $request->get('category_id')) {
            $query->where('category_id', $categoryId);
        }

        // Pagination (10 par page, tu peux ajuster)
        $subcategories = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Pour le filtre dropdown
        $categories = Category::orderBy('nom')->get();

        return view('admin.subcategories.index', compact('subcategories', 'categories'));
    }
    // Formulaire création
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    // Enregistrer nouvelle sous-catégorie
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('subcategories', 'public');
        }

        SubCategory::create($data);

        return redirect()->route('admin.subcategories.index')->with('success', 'Sous-catégorie ajoutée avec succès !');
    }

    // Formulaire édition
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    // Mettre à jour
    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('subcategories', 'public');
        }

        $subcategory->update($data);

        return redirect()->route('admin.subcategories.index')->with('success', 'Sous-catégorie mise à jour avec succès !');
    }

    // Supprimer
    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')->with('success', 'Sous-catégorie supprimée !');
    }
}
