<?php

namespace App\Http\Controllers\livrer;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ad;
use Illuminate\Http\Request;

class DeliveryAdController extends Controller
{
    /**
     * Liste des annonces avec livraison active
     */
    public function index()
    {
        $bookings = Booking::with(['ad.user', 'ad.category'])
            ->whereIn('status', ['pending', 'accepted']) 
            ->latest()
            ->get();
        $ads = $bookings->map(function ($booking) {
            $ad = $booking->ad;
            $ad->booking_id = $booking->id;
            $ad->start_date = $booking->start_date;
            $ad->status = $booking->status;
            $ad->end_date = $booking->end_date;
            $ad->total_price = $booking->total_price;
            $ad->client_address =$booking->ad->client_address;
            return $ad;
        });

        return view('livreur.ads.index', compact('ads'));
    }

    /**
     * Accepter une annonce
     */
    public function accept(Ad $ad)
    {
        $ad->update([
            'status' => 'confirmed', 
        ]);

        return back()->with('success', 'Annonce confirmée.');
    }
    /**
     * Refuser une annonce
     */
    public function reject(Ad $ad)
    {
        $ad->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Annonce refusée.');
    }
}
