<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StatsController extends Controller
{ 
    public function adsStats(Request $request)
    {
        $period = $request->get('period', 'week');
        $visitFilter = $request->get('visitFilter', 'all');
        $adFilter = $request->get('annonceFilter', 'all');

        Carbon::setLocale('fr');

        // Définir la période
        if ($period === 'custom') {
            $start = Carbon::parse($request->get('start'))->startOfDay();
            $end   = Carbon::parse($request->get('end'))->endOfDay();
        } else {
            switch ($period) {
                case 'month':
                    $start = now()->startOfMonth();
                    $end   = now()->endOfMonth();
                    break;
                case 'year':
                    $start = now()->startOfYear();
                    $end   = now()->endOfYear();
                    break;
                default:
                    $start = now()->subDays(6)->startOfDay();
                    $end   = now()->endOfDay();
            }
        }

        // Query des annonces
        $adQuery = Ad::where('user_id', auth()->id())
                    ->whereBetween('created_at', [$start, $end]);

        if ($adFilter === 'active') {
            $adQuery->where('is_approved', 1);
        } elseif ($adFilter === 'inactive') {
            $adQuery->where('is_approved', 0);
        }

        $ads = $adQuery->get();
        $adIds = $ads->pluck('id');

        // Préparer les visites selon le filtre
        $visitsQuery = AdVisit::whereIn('ad_id', $adIds)
                            ->whereBetween('created_at', [$start, $end]);

        if ($visitFilter === 'unique') {
            // Une visite par user+IP par jour
            $visitsQuery->selectRaw('ad_id, user_id, ip, created_at')
                        ->groupBy('ad_id', 'user_id', 'ip', 'created_at');
        } elseif ($visitFilter === 'repeat') {
            $visitsQuery->selectRaw('ad_id, user_id, ip, created_at, COUNT(*) as count')
                        ->groupBy('ad_id', 'user_id', 'ip', 'created_at')
                        ->havingRaw('COUNT(*) > 1');
        }

        $visits = $visitsQuery->get()->groupBy(function($v) {
            return Carbon::parse($v->created_at)->format('Y-m-d');
        });

        // Préparer les données du graphique
        $labels = [];
        $adsData = [];
        $viewsData = [];

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $key = $date->format('Y-m-d');

            // Compter les annonces par jour
            $adsCount = $ads->whereBetween('created_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()])->count();

            // Compter les vues selon le filtre
            $dayVisits = $visits[$key] ?? collect();
            $viewsCount = $visitFilter === 'repeat' ? $dayVisits->sum('count') : $dayVisits->count();

            $labels[] = $date->translatedFormat('d M');
            $adsData[] = $adsCount;
            $viewsData[] = $viewsCount;
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Nombre d’annonces',
                    'data' => $adsData
                ],
                [
                    'label' => 'Nombre de vues',
                    'data' => $viewsData
                ]
            ]
        ]);
    }
}