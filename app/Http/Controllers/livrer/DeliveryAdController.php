<?php

namespace App\Http\Controllers\livrer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DemandeLivreur;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LivraisonColis;

class DeliveryAdController extends Controller
{
    public function index()
    {
        $livreurId = auth()->id();
        $requestedBookingIds = DemandeLivreur::where('id_livreur', $livreurId)
            ->pluck('id_annonce');
        $acceptedBookingIds = DemandeLivreur::where('statut', 'acceptee')
            ->pluck('id_annonce');
        $adsDisponibles = Booking::with(['ad.user', 'ad.category'])
            ->where('status', 'pending')
            ->whereNotIn('ad_id', $requestedBookingIds)
            ->whereNotIn('ad_id', $acceptedBookingIds)
            ->whereHas('ad', function ($q) {
                $q->where('delivery_active', true);
            })
            ->latest()
            ->get()
            ->map(function ($booking) {
                $ad = $booking->ad;
                $ad->booking_id = $booking->id;
                $ad->start_date = $booking->start_date;
                $ad->end_date = $booking->end_date;
                $ad->total_price = $booking->total_price;
                $ad->delivery_cost = $booking->delivery_cost;
                $ad->status = $booking->status;
                return $ad;
            });
        $adsDemandees = Ad::whereIn('id', function ($q) use ($livreurId) {
            $q->select('id_annonce')
            ->from('demande_livreur')
            ->where('id_livreur', $livreurId)
            ->where('statut', 'en_attente');
        })
            ->with(['user', 'category'])
            ->get();
        $adsEnCours = Ad::whereIn('id', function ($q) use ($livreurId) {
            $q->select('id_annonce')
            ->from('demande_livreur')
            ->where('id_livreur', $livreurId)
            ->where('statut', 'acceptee');
        })
            ->with(['user', 'category'])
            ->get();
        return view('livreur.ads.index', compact('adsDisponibles', 'adsDemandees', 'adsEnCours'));
    }
    public function sendRequest(Request $request, Ad $ad)
    {
        $livreur = auth()->user();

        DemandeLivreur::updateOrCreate(
            ['id_livreur' => $livreur->id, 'id_annonce' => $ad->id],
            ['statut' => 'en_attente', 'date_demande' => now()]
        );

        return back()->with('success', 'Demande envoyée avec succès');
    }
    public function historiqueTermine()
    {
        $livreurId = Auth::id();

        $livraisonsTerminees = LivraisonColis::where('livreur_id', $livreurId)
            ->where('statut', 'livré')
            ->with('expediteur')
            ->orderBy('date_creation', 'desc')
            ->get();

        $totalLivres = $livraisonsTerminees->count();
        $revenusCumules = $livraisonsTerminees->sum('prix_total_affiche');

        return view('livreur.ads.termine', compact('livraisonsTerminees', 'totalLivres', 'revenusCumules'));
    }
}
