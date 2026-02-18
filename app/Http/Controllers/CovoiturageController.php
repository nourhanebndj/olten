<?php

namespace App\Http\Controllers;

use App\Models\Covoiturage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CovoiturageController extends Controller
{
    public function index()
    {
        $trajets = Covoiturage::where('conducteur_id', auth()->id())
            ->orderBy('date_depart', 'desc')
            ->get();

        return view('livreur.covoiturage.index', compact('trajets'));
    }
    public function show($covoiturage_id)
    {
        $trajet = Covoiturage::findOrFail($covoiturage_id);

        $segments = $trajet->segments ?? [];
        $route = $trajet->selected_route ?? null;

        $prixTotal = collect($segments)->sum(fn ($segment) => $segment['price'] ?? 0);

        return view('livreur.covoiturage.show', [
            'trajet' => $trajet,
            'segments' => $segments,
            'route' => $route,
            'prixTotal' => $prixTotal
        ]);
    }


    public function create()
    {
        return view('livreur.covoiturage.create');
    }

    public function publish(Request $request)
    {
        $input = $request->all();
        $input['itineraire'] = json_decode($request->input('itineraire'), true) ?? [];
        $input['segments'] = json_decode($request->input('segments'), true) ?? [];
        $input['selected_route'] = json_decode($request->input('selected_route'), true) ?? [];
        $input['selected_route_index'] = (int) $request->input('selected_route_index', 0);

        $data = Validator::make($input, [
            'depart' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'date_depart' => 'required|date',
            'heure_depart' => 'required|string|max:5',
            'nb_places' => 'required|integer|min:1',
            'retour' => 'required|boolean',
            'itineraire' => 'required|array|min:2',
            'segments' => 'required|array|min:1',
            'message_conducteur' => 'nullable|string|max:2000',
            'photo_conducteur' => 'nullable|image|max:2048',
            'passenger_mode' => 'required|string|in:mixed,womenOnly,maxBackSeats',
            'selected_route' => 'nullable|array',
            'selected_route_index' => 'nullable|integer|min:0',
        ])->validate();

        $prixTotal = collect($input['segments'])
            ->sum(fn ($segment) => (float)($segment['price'] ?? 0));

        $data['prix_place'] = $prixTotal;
        $data['prix_total_affiche'] = $prixTotal;
        $data['retour'] = (bool) $data['retour'];

        if ($request->hasFile('photo_conducteur')) {
            $file = $request->file('photo_conducteur');
            $filename = uniqid('driver_') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('drivers', $filename, 'public');
            $data['photo_conducteur'] = $path;
        }

        $data['conducteur_id'] = Auth::id();
        $data['statut'] = 'pending';

        $covoiturage = Covoiturage::create($data);

        return response()->json([
            'success' => true,
            'covoiturage_id' => $covoiturage->covoiturage_id
        ]);
    }

}
