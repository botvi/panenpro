<?php

namespace App\Http\Controllers\asisten;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mandor;
use App\Models\Pemanen;
use App\Models\DataPanen;
use App\Models\AbsensiBerkala;
use App\Models\AbsensiPemanen;
use App\Models\PlanAKP;
use App\Models\AktualAKP;
use App\Models\GrafikKepatuhan;
use Illuminate\Support\Facades\Auth;

class DashboardAsistenController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'asisten') {
                return redirect()->route('formlogin')->with('error', 'Access denied');
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Get current asisten info
        $asisten = Auth::user();

        // Get statistics for dashboard
        $totalMandor = Mandor::count();
        $totalPemanen = Pemanen::count();
        $totalDataPanen = DataPanen::count();
        $totalAbsensi = AbsensiBerkala::count() + AbsensiPemanen::count();

        // Get recent data
        $recentMandor = Mandor::with('user')->latest()->limit(5)->get();
        $recentPemanen = Pemanen::with('user')->latest()->limit(5)->get();
        $recentDataPanen = DataPanen::with('pemanen')->latest()->limit(10)->get();

        // Get harvest summary first
        $harvestSummary = DataPanen::selectRaw('
            SUM(ripe) as total_ripe,
            SUM(over_ripe) as total_over_ripe, 
            SUM(under_ripe) as total_under_ripe,
            SUM(eb) as total_eb,
            SUM(brondolan) as total_brondolan,
            SUM(jumlah_buah_per_blok) as total_buah
        ')->first();

        // Get chart data for harvest production with formatted data for Chart.js
        $monthlyHarvest = DataPanen::selectRaw('MONTH(created_at) as month, SUM(jumlah_buah_per_blok) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format monthly data for Chart.js
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthlyLabels = [];
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyLabels[] = $monthNames[$i - 1];
            $harvest = $monthlyHarvest->where('month', $i)->first();
            $monthlyData[] = $harvest ? $harvest->total : 0;
        }

        // Get daily harvest for last 30 days for trend analysis
        $dailyHarvest = DataPanen::selectRaw('DATE(created_at) as date, SUM(jumlah_buah_per_blok) as total')
            ->whereBetween('created_at', [now()->subDays(29), now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format daily data for Chart.js  
        $dailyLabels = [];
        $dailyData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dailyLabels[] = now()->subDays($i)->format('M d');
            $harvest = $dailyHarvest->where('date', $date)->first();
            $dailyData[] = $harvest ? $harvest->total : 0;
        }

        // Get quality distribution data for pie chart
        $qualityData = [
            'ripe' => $harvestSummary->total_ripe ?? 0,
            'over_ripe' => $harvestSummary->total_over_ripe ?? 0,
            'under_ripe' => $harvestSummary->total_under_ripe ?? 0,
            'eb' => $harvestSummary->total_eb ?? 0,
            'brondolan' => $harvestSummary->total_brondolan ?? 0
        ];

        // Get plan vs actual AKP data
        $planAKP = PlanAKP::sum('total') ?? 0;
        $aktualAKP = AktualAKP::sum('total') ?? 0;

        // Get compliance data
        $totalGrafikKepatuhan = GrafikKepatuhan::count();

        return view('pageasisten.dashboard.index', compact(
            'asisten',
            'totalMandor',
            'totalPemanen',
            'totalDataPanen',
            'totalAbsensi',
            'recentMandor',
            'recentPemanen',
            'recentDataPanen',
            'monthlyLabels',
            'monthlyData',
            'dailyLabels',
            'dailyData',
            'planAKP',
            'aktualAKP',
            'harvestSummary',
            'totalGrafikKepatuhan',
            'qualityData'
        ));
    }
}
