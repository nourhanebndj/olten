<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class WalletController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $adEarnings = Booking::whereHas('ad', function ($q) use ($user) {
                                $q->where('user_id', $user->id);
                            })
                            ->where('status', 'paid')
                            ->sum('total_price');

        $productEarnings = $user->products()
                                ->with(['sales' => function ($q) {
                                    $q->where('status', 'paid');
                                }])
                                ->get()
                                ->sum(function ($product) {
                                    return $product->sales->sum('total_price');
                                });

        $totalEarnings = $adEarnings + $productEarnings;
        return view('pages.wallet', compact('user', 'adEarnings', 'productEarnings', 'totalEarnings'));
    }
}