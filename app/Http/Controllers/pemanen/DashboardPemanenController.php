<?php

namespace App\Http\Controllers\pemanen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataPanen;
use App\Models\Pemanen;
use Illuminate\Support\Facades\Auth;

class DashboardPemanenController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;

        // Get pemanen info
        $pemanen = Pemanen::where('user_id', $userId)->first();

        if (!$pemanen) {
            return redirect()->back()->with('error', 'Data pemanen tidak ditemukan');
        }

        // Get statistics for this pemanen
        $totalDataPanen = DataPanen::where('pemanen_id', $pemanen->id)->count();
        $totalRipe = DataPanen::where('pemanen_id', $pemanen->id)->sum('ripe');
        $totalOverRipe = DataPanen::where('pemanen_id', $pemanen->id)->sum('over_ripe');
        $totalUnderRipe = DataPanen::where('pemanen_id', $pemanen->id)->sum('under_ripe');
        $totalBuah = DataPanen::where('pemanen_id', $pemanen->id)->sum('jumlah_buah_per_blok');
        $totalBrondolan = DataPanen::where('pemanen_id', $pemanen->id)->sum('brondolan');

        // Get recent harvest data
        $recentDataPanen = DataPanen::where('pemanen_id', $pemanen->id)->latest()->limit(10)->get();

        // Get monthly harvest trend for this pemanen with formatted data for Chart.js
        $monthlyHarvest = DataPanen::where('pemanen_id', $pemanen->id)
            ->selectRaw('MONTH(created_at) as month, SUM(jumlah_buah_per_blok) as total')
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

        // Get daily harvest for last 7 days
        $dailyHarvest = DataPanen::where('pemanen_id', $pemanen->id)
            ->selectRaw('DATE(created_at) as date, SUM(jumlah_buah_per_blok) as total')
            ->whereBetween('created_at', [now()->subDays(6), now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format daily data for Chart.js
        $dailyLabels = [];
        $dailyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dailyLabels[] = now()->subDays($i)->format('M d');
            $harvest = $dailyHarvest->where('date', $date)->first();
            $dailyData[] = $harvest ? $harvest->total : 0;
        }

        // Get harvest quality distribution
        $qualityData = DataPanen::where('pemanen_id', $pemanen->id)
            ->selectRaw('SUM(ripe) as ripe, SUM(over_ripe) as over_ripe, SUM(under_ripe) as under_ripe, SUM(eb) as eb, SUM(brondolan) as brondolan')
            ->first();

        // Format quality data for pie chart
        $qualityChartData = [
            'ripe' => $qualityData->ripe ?? 0,
            'over_ripe' => $qualityData->over_ripe ?? 0,
            'under_ripe' => $qualityData->under_ripe ?? 0,
            'eb' => $qualityData->eb ?? 0,
            'brondolan' => $qualityData->brondolan ?? 0
        ];

        // Get block wise harvest data
        $blockData = DataPanen::where('pemanen_id', $pemanen->id)
            ->selectRaw('blok_id, SUM(jumlah_buah_per_blok) as total_buah')
            ->groupBy('blok_id')
            ->orderBy('total_buah', 'desc')
            ->limit(10)
            ->get();

        // Format block data for chart
        $blockLabels = [];
        $blockChartData = [];
        foreach ($blockData as $block) {
            $blockLabels[] = $block->blok->blok;
            $blockChartData[] = $block->total_buah;
        }

        // Calculate productivity metrics
        $averageDaily = $totalDataPanen > 0 ? $totalBuah / $totalDataPanen : 0;
        $qualityScore = $totalBuah > 0 ? ($totalRipe / $totalBuah) * 100 : 0;

        // Get today's harvest
        $todayHarvest = DataPanen::where('pemanen_id', $pemanen->id)
            ->whereDate('created_at', today())
            ->sum('jumlah_buah_per_blok');

        // Get this week's harvest
        $weeklyHarvest = DataPanen::where('pemanen_id', $pemanen->id)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('jumlah_buah_per_blok');

        // Get this month's harvest
        $monthlyHarvestTotal = DataPanen::where('pemanen_id', $pemanen->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah_buah_per_blok');

        return view('pagepemanen.dashboard.index', compact(
            'pemanen',
            'totalDataPanen',
            'totalRipe',
            'totalOverRipe',
            'totalUnderRipe',
            'totalBuah',
            'totalBrondolan',
            'recentDataPanen',
            'monthlyHarvest',
            'qualityData',
            'blockData',
            'monthlyLabels',
            'monthlyData',
            'dailyLabels',
            'dailyData',
            'qualityChartData',
            'blockLabels',
            'blockChartData',
            'averageDaily',
            'qualityScore',
            'todayHarvest',
            'weeklyHarvest',
            'monthlyHarvestTotal'
        ));
    }
}
