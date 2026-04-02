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
        $itineraire = $trajet->itineraire ?? [];
        $selectedRoute = $trajet->selected_route ?? [];
        $returnTripData = $trajet->return_trip_data ?? null;

        $prixTotal = collect($segments)
            ->sum(fn ($segment) => $segment['price'] ?? 0);

        return view('livreur.covoiturage.show', [
            'trajet' => $trajet,
            'segments' => $segments,
            'route' => $selectedRoute,
            'prixTotal' => $prixTotal,
            'itineraire' => $itineraire,
            'selectedRoute' => $selectedRoute,
            'returnTripData' => $returnTripData,
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
        $input['return_trip_data'] = json_decode($request->input('return_trip_data'), true);
        $input['return_datetime'] = json_decode($request->input('return_datetime'), true);

        $data = Validator::make($input, [
            'depart' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'date_depart' => 'required|date',
            'heure_depart' => 'required|string|max:5',
            'nb_places' => 'required|integer|min:1',
            'itineraire' => 'required|array|min:2',
            'segments' => 'required|array|min:1',
            'message_conducteur' => 'nullable|string|max:2000',
            'photo_conducteur' => 'nullable|image|max:2048',
            'passenger_mode' => 'required|string|in:mixed,womenOnly,maxBackSeats',
            'selected_route' => 'nullable|array',
            'selected_route_index' => 'nullable|integer|min:0',
            'return_trip_data' => 'nullable|array',
            'return_datetime' => 'nullable|array',
        ])->validate();

        $prixTotal = collect($input['segments'])
            ->sum(fn ($segment) => (float)($segment['price'] ?? 0));

        $data['prix_place'] = $prixTotal;
        $data['prix_total_affiche'] = $prixTotal;

        $returnTrip = $input['return_trip_data'] ?? null;
        $returnDate = $input['return_datetime']['date'] ?? null;
        $returnTime = $input['return_datetime']['time'] ?? null;

        $hasReturn =
            !empty($returnTrip) &&
            !empty($returnDate) &&
            !empty($returnTime);

        $data['retour'] = $hasReturn;
        $data['return_trip_data'] = $hasReturn ? $returnTrip : null;
        $data['return_date'] = $hasReturn ? $returnDate : null;
        $data['return_time'] = $hasReturn ? $returnTime : null;

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
    public function destroy($id)
    {
        $covoiturage = Covoiturage::where('covoiturage_id', $id)
            ->where('conducteur_id', Auth::id())
            ->first();

        if (!$covoiturage) {
            return response()->json([
                'success' => false,
                'message' => 'Trajet introuvable'
            ], 404);
        }

        if ($covoiturage->photo_conducteur) {
            \Storage::disk('public')->delete($covoiturage->photo_conducteur);
        }

        $covoiturage->delete();

        return redirect()
         ->route('covoiturage.index')
         ->with('success', 'Trajet supprimé avec succès');
    }
    public function edit($id)
    {
        $trajet = Covoiturage::findOrFail($id);

        return view('livreur.covoiturage.edit', compact('trajet'));
    }

    public function update(Request $request, $id)
    {
        $trajet = Covoiturage::findOrFail($id);

        $data = $request->validate([
            'depart' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'date_depart' => 'required|date',
            'heure_depart' => 'required',
            'nb_places' => 'required|integer|min:1|max:8',
            'prix_place' => 'required|numeric|min:0',
            'passenger_mode' => 'required'
        ]);

        $trajet->update($data);

        return redirect()
            ->route('covoiturage.index', $trajet->covoiturage_id)
            ->with('success', 'Trajet mis à jour');
    }
    public function editOptions($id)
    {
        $covoiturage = Covoiturage::findOrFail($id);

        return view('livreur.covoiturage.edit_det.option', compact('covoiturage'));
    }
    public function updateOptions(Request $request, $id)
    {
        $covoiturage = Covoiturage::findOrFail($id);

        $request->validate([
            'nb_places' => 'required|integer|min:1|max:10',
            'booking_mode' => 'required|in:instant,manual',
            'passenger_mode' => 'required|in:mixed,womenOnly,maxBackSeats',
            'message_conducteur' => 'nullable|string|max:500',
        ]);

        $maxArriere = false;
        $entreFemmes = false;

        switch ($request->passenger_mode) {
            case 'mixed':
                $maxArriere = false;
                $entreFemmes = false;
                break;
            case 'womenOnly':
                $maxArriere = false;
                $entreFemmes = true;
                break;
            case 'maxBackSeats':
                $maxArriere = true;
                $entreFemmes = false;
                break;
        }

        $covoiturage->update([
            'nb_places' => $request->nb_places,
            'booking_mode' => $request->booking_mode,
            'passenger_mode' => json_encode([
                'passenger_mode' => $request->passenger_mode,
                'max_arriere' => $maxArriere,
                'entre_femmes' => $entreFemmes,
            ]),
            'message_conducteur' => $request->message_conducteur,
        ]);

        return redirect()->back()->with('success', 'Options mises à jour avec succès');
    }
    public function editPrice($id)
    {
        $covoiturage = Covoiturage::findOrFail($id);

        $segments = $covoiturage->segments ?? [];
        $returnSegments = [];
        if (!empty($covoiturage->selected_route) && isset($covoiturage->selected_route['pricing'])) {
            $returnSegments = $covoiturage->selected_route['pricing'];
        }

        return view('livreur.covoiturage.edit_det.prix', compact(
            'covoiturage',
            'segments',
            'returnSegments'
        ));
    }
    public function updatePrice(Request $request, $id)
    {
        $covoiturage = Covoiturage::findOrFail($id);
        $segments = $request->input('segments', []);
        $returnSegments = $request->input('return_segments', []);
        $covoiturage->segments = $segments;
        $selectedRoute = $covoiturage->selected_route ?? [];
        $selectedRoute['pricing'] = $returnSegments;
        $covoiturage->selected_route = $selectedRoute;
        $totalAller = array_sum(array_map(fn ($seg) => $seg['price'] ?? 0, $segments));
        $totalRetour = array_sum(array_map(fn ($seg) => $seg['price'] ?? 0, $returnSegments));
        $covoiturage->prix_total_affiche = $request->prix_total_affiche;
        $covoiturage->save();
        return redirect()->back()->with('success', 'Tarifs mis à jour avec succès !');
    }
    public function edititen($id)
    {
        $covoiturage = Covoiturage::findOrFail($id);
        return view('livreur.covoiturage.edit_det.iten', compact(
            'covoiturage'
        ));
    }
    public function editDateTime($id)
    {
        $covoiturage = Covoiturage::findOrFail($id);
        return view('livreur.covoiturage.edit_det.edit_date_time', compact('covoiturage'));
    }

    public function updateDateTime(Request $request, $id)
    {
        $covoiturage = Covoiturage::findOrFail($id);

        $request->validate([
            'date_depart' => 'required|date',
            'heure_depart' => 'required|date_format:H:i',
        ]);

        $covoiturage->update([
            'date_depart' => $request->date_depart,
            'heure_depart' => $request->heure_depart,
        ]);

        return redirect()->route('covoiturage.edit-date-time', $id)
            ->with('success', 'Date et heure mises à jour avec succès !');
    }
    public function dupliquer(Covoiturage $covoiturage)
    {
        $newTrip = $covoiturage->replicate();
        $newTrip->statut = 'pending';
        $newTrip->save();

        return response()->json([
            'success' => true,
            'covoiturage_id' => $newTrip->covoiturage_id
        ]);
    }

    public function editRoute(Covoiturage $covoiturage)
    {
        if ($covoiturage->conducteur_id !== Auth::id()) {
            abort(403);
        }

        return view('livreur.covoiturage.edit_det.edit-route', compact('covoiturage'));
    }

    public function updateRoute(Request $request, Covoiturage $covoiturage)
    {
        if ($covoiturage->conducteur_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Non autorisé.'], 403);
        }

        $validated = $request->validate([
            'depart'      => 'required|string|max:500',
            'destination'  => 'required|string|max:500',
            'itineraire'   => 'required|string',
            'segments'     => 'required|string',
        ]);

        $itineraire = json_decode($validated['itineraire'], true);
        $segments   = json_decode($validated['segments'], true);

        /*
         * Format attendu pour itineraire :
         * [
         *   { "name": "Adresse complète...", "type": "start", "latlng": [47.23, 6.03] },
         *   { "name": "Moisenay",           "type": "waypoint", "latlng": [48.56, 2.76] },
         *   { "name": "Adresse complète...", "type": "end",   "latlng": [47.28, -0.53] }
         * ]
         *
         * Format attendu pour segments :
         * [
         *   { "from": "Adresse départ...", "to": "Moisenay", "price": 52 },
         *   { "from": "Moisenay", "to": "Adresse arrivée...", "price": 20 }
         * ]
         */

        // Calculer le prix total à partir des segments
        $prixTotal = collect($segments)->sum(fn ($s) => (float)($s['price'] ?? 0));

        $covoiturage->update([
            'depart'            => $validated['depart'],
            'destination'       => $validated['destination'],
            'itineraire'        => $itineraire,
            'segments'          => $segments,
            'prix_place'        => $prixTotal,
            'prix_total_affiche' => $prixTotal,
        ]);

        return response()->json(['success' => true]);
    }
}
