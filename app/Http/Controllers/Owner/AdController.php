<?php

namespace App\Http\Controllers\Owner;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $query = Ad::where('user_id', Auth::id())->with('category')->latest();

        if ($search) {
            $query->where('title', 'ILIKE', "%{$search}%");
        }

        if ($categoryId && $categoryId !== 'all') {
            $query->where('category_id', $categoryId);
        }

        $ads = $query->paginate(8)->withQueryString();

        $categories = Category::all();

        return view('pages.locateur.mes_annonces', compact('ads', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.locateur.deposer_annonce', compact('categories'));
    }

    public function reverseGeocode(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        $response = Http::withHeaders([
            'User-Agent' => 'OltenApp/1.0 (contact@olten.com)'
        ])->get('https://nominatim.openstreetmap.org/reverse', [
            'format' => 'jsonv2',
            'lat' => $request->lat,
            'lon' => $request->lng,
        ]);

        return response()->json($response->json());
    }

    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Le titre est obligatoire.',
            'title.max'      => 'Le titre ne peut pas dépasser :max caractères.',
            'category_id.required' => 'La catégorie est obligatoire.',
            'category_id.exists'   => 'La catégorie sélectionnée est invalide.',
            'price_per_day.required' => 'Le prix par jour est obligatoire.',
            'price_per_day.numeric'  => 'Le prix doit être un nombre.',
            'image.image'    => "Le fichier doit être une image.",
            'image.mimes'    => "L'image doit être au format :values.",
            'image.max'      => "L'image ne peut pas dépasser 2Mo.",
        ];

        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'category_id'     => 'required|exists:categories,id',
            'address'         => 'nullable|string|max:255',
            'longitude'       => 'nullable|numeric',
            'latitude'        => 'nullable|numeric',
            'price_per_day'   => 'required|numeric|min:0',
            'client_address'  => 'nullable|string|max:255',
            'price_per_km'    => 'nullable|numeric|min:0',
            'distance_km'     => 'nullable|numeric|min:0',
            'delivery_cost'   => 'nullable|numeric|min:0',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);

        $validated['delivery_active'] = $request->has('delivery_active');

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public'); 
            $validated['image'] = $path;
        }

        Ad::create($validated);

        return redirect()->route('ads.index')->with('success', 'Annonce créée avec succès !');
    }

    public function exportICal(Ad $ad)
    {
        $icalContent = "BEGIN:VCALENDAR
                        VERSION:2.0
                        PRODID:-//Olten//Annonce Calendar//FR
                        BEGIN:VEVENT
                        UID:ad-{$ad->id}@olten.fr
                        DTSTAMP:" . now()->format('Ymd\THis\Z') . "
                        SUMMARY:Annonce - {$ad->title}
                        DESCRIPTION:Voir annonce sur Olten
                        END:VEVENT
                        END:VCALENDAR";

        return response($icalContent, 200)->header('Content-Type', 'text/calendar')->header('Content-Disposition', "attachment; filename=ad-{$ad->id}.ics");
    }

    public function destroy(Ad $ad)
    {
        $this->authorize('delete', $ad);
        $ad->delete();
        return redirect()->route('ads.index')->with('success', 'Annonce supprimée avec succès.');
    }
}
