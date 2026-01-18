<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Ad;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, Ad $ad)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.required' => 'La date de début est obligatoire.',
            'end_date.required'   => 'La date de fin est obligatoire.',
            'end_date.after_or_equal' => 'La date de fin doit être égale ou après la date de début.',
        ]);

        if ($validated['start_date'] < $ad->available_from->format('Y-m-d') || 
            $validated['end_date'] > $ad->available_until->format('Y-m-d')) {
            return back()->withErrors(['dates' => 'Les dates choisies ne sont pas disponibles pour cette annonce.']);
        }

        $booking = new Booking();
        $booking->ad_id = $ad->id;
        $booking->user_id = auth()->id();
        $booking->start_date = $validated['start_date'];
        $booking->end_date = $validated['end_date'];

        if ($ad->delivery_active) {
            $booking->delivery_cost = $ad->delivery_cost ?? 0;
        }

        $booking->calculateTotalPrice();
        $booking->save();

        return back()->with('success', 'Réservation effectuée avec succès !');
    }
}