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

        // $booking = new Booking();
        // $booking->ad_id = $ad->id;
        // $booking->user_id = auth()->id();
        // $booking->start_date = $validated['start_date'];
        // $booking->end_date = $validated['end_date'];

        // if ($ad->delivery_active) {
        //     $booking->delivery_cost = $ad->delivery_cost ?? 0;
        // }

        // $booking->calculateTotalPrice();
        // $booking->save();

        // return back()->with('success', 'Réservation effectuée avec succès !');
        return redirect()->route('bookings.confirm')->with([
            'ad' => $ad,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }

    public function confirm()
    {
        if (!session()->has('start_date')) {
            return redirect()->back();
        }

        return view('pages.annonces_pages.confirm_booking');
    }

    public function pay(Request $request)
    {
        $user = Auth::user();

        Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $intent = Stripe\PaymentIntent::create([
            'amount' => 5000,
            'currency' => 'eur',
            'payment_method' => $request->payment_method,
            'confirm' => true,
            'automatic_payment_methods' => ['enabled' => true],
        ]);


        return response()->json([
            'success' => true,
            'redirect' => route('bookings.success')
        ]);
    }

}