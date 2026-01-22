<?php

namespace App\Http\Controllers\livrer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Booking;
use App\Models\DemandeLivreur;
use App\Models\LivraisonColis;
use App\Models\PointsFidelite;
use Illuminate\Support\Facades\Auth;

class AdsLivreurController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $mesAnnonces = Ad::where('user_id', $userId)
            ->with(['demandes.livreur'])
            ->get();
        $missionsReussies = LivraisonColis::where('livreur_id', $userId)
            ->where('statut', 'livré')
            ->count();
        $totalPoints = PointsFidelite::where('user_id', $userId)
            ->sum('points_gagnes');
        $scoreLivreur = min(5, round($totalPoints / 100, 1));
        $proximiteKm = LivraisonColis::where('livreur_id', $userId)
            ->where('statut', 'livré')
            ->avg('distance_km');
        $proximiteKm = round($proximiteKm ?? 0);
        return view('livreur.ads.confirme', compact(
            'mesAnnonces',
            'missionsReussies',
            'scoreLivreur',
            'proximiteKm',
            'totalPoints'
        ));
    }
    public function acceptDemande(DemandeLivreur $demande)
    {
        $demande->statut = 'acceptee';
        $demande->save();

        DemandeLivreur::where('id_annonce', $demande->id_annonce)
            ->where('id_demande', '!=', $demande->id_demande)
            ->update(['statut' => 'refusee']);

        return back()->with('success', 'Demande acceptée.');
    }
    public function refuseDemande(DemandeLivreur $demande)
    {
        $demande->statut = 'refusee';
        $demande->save();

        return back()->with('success', 'Demande refusée.');
    }
    public function finaliserMission(Request $request, DemandeLivreur $demande)
    {
        $livreurId = auth()->id();

        if ($demande->id_livreur !== $livreurId) {
            return back()->with('error', 'Vous n’êtes pas autorisé à finaliser cette mission.');
        }

        $ad = $demande->ad;
        $booking = Booking::where('ad_id', $ad->id)
                        ->where('status', 'pending')
                        ->first();

        if (!$booking) {
            return back()->with('error', 'Réservation introuvable pour cette annonce.');
        }

        LivraisonColis::create([
            'expediteur_id'           => $booking->user_id, 
            'livreur_id'              => $livreurId,
            'objet_description'       => $ad->title,
            'adresse_depart'          => $ad->address,
            'adresse_arrivee'         => $ad->client_address,
            'distance_km'             => $ad->distance_km ?? 0,
            'prix_base'               => $ad->price_per_day ?? 0,
            'commission_plateforme'   => $ad->delivery_cost ?? 0,
            'prix_total_affiche'      => ($ad->price_per_day ?? 0) + ($ad->delivery_cost ?? 0),
            'statut'                  => 'livré',
            'reglementation_transport'=> '', 
            'date_creation'           => now(),
            'raison'                  => $request->raison ?? null,
        ]);
        $demande->statut = 'terminee';
        $demande->save();

        return back()->with('success', 'Mission finalisée et enregistrée.');
    }
    public function annulerMission(DemandeLivreur $demande)
    {
        $livreurId = auth()->id();
        if ($demande->id_livreur !== $livreurId) {
            return back()->with('error', 'Vous n’êtes pas autorisé à annuler cette mission.');
        }
        $demande->statut = 'refusee';
        $demande->save();

        return back()->with('success', 'Mission annulée avec succès.');
    }

}
