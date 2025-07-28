<?php

namespace App\Http\Controllers\mandor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pemanen;
use App\Models\DataPanen;
use App\Models\AbsensiBerkala;
use App\Models\AbsensiPemanen;
use App\Models\GrafikKepatuhan;
use App\Models\PlanAKP;
use App\Models\AktualAKP;
use App\Models\Mandor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardMandorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mandorId = $user->id;

        // Get current mandor info
        $mandor = Mandor::where('user_id', $mandorId)->first();
        if (!$mandor) {
            $mandor = $user; // fallback to user data
        }

        // Get pemanen IDs for this mandor
        $pemanenIds = Pemanen::where('mandor_id', $mandorId)->pluck('id');

        // Get basic statistics
        $totalPemanen = Pemanen::where('mandor_id', $mandorId)->count();
        $totalDataPanen = DataPanen::whereIn('pemanen_id', $pemanenIds)->count();
        $totalAbsensiBerkala = AbsensiBerkala::where('mandor_id', $mandorId)->count();
        $totalAbsensiPemanen = AbsensiPemanen::where('mandor_id', $mandorId)->count();
        $totalAbsensi = $totalAbsensiBerkala + $totalAbsensiPemanen;
        $totalGrafikKepatuhan = GrafikKepatuhan::where('mandor_id', $mandorId)->count();

        // Today's statistics
        $todayHarvest = DataPanen::whereIn('pemanen_id', $pemanenIds)
            ->whereDate('created_at', today())
            ->sum('jumlah_buah_per_blok');

        $thisWeekHarvest = DataPanen::whereIn('pemanen_id', $pemanenIds)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('jumlah_buah_per_blok');

        $thisMonthHarvest = DataPanen::whereIn('pemanen_id', $pemanenIds)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah_buah_per_blok');

        // Harvest quality summary
        $harvestSummary = DataPanen::whereIn('pemanen_id', $pemanenIds)
            ->selectRaw('
                SUM(ripe) as total_ripe,
                SUM(over_ripe) as total_over_ripe,
                SUM(under_ripe) as total_under_ripe,
                SUM(eb) as total_eb,
                SUM(brondolan) as total_brondolan,
                SUM(jumlah_buah_per_blok) as total_buah
            ')
            ->first();

        // Recent data
        $recentPemanen = Pemanen::where('mandor_id', $mandorId)->latest()->limit(5)->get();
        $recentDataPanen = DataPanen::whereIn('pemanen_id', $pemanenIds)
            ->with('pemanen')
            ->latest()
            ->limit(10)
            ->get();

        $recentAbsensi = AbsensiPemanen::with('pemanen')
            ->where('mandor_id', $mandorId)
            ->latest()
            ->limit(10)
            ->get();

        $recentGrafikKepatuhan = GrafikKepatuhan::with('pemanen')
            ->where('mandor_id', $mandorId)
            ->latest()
            ->limit(5)
            ->get();

        // Monthly harvest data for chart
        $monthlyHarvest = DataPanen::whereIn('pemanen_id', $pemanenIds)
            ->selectRaw('MONTH(created_at) as month, SUM(jumlah_buah_per_blok) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $monthlyLabels = [];
        $monthlyData = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthlyLabels[] = $monthNames[$i - 1];
            $monthlyData[] = $monthlyHarvest->get($i, 0);
        }

        // Daily harvest data for chart (last 7 days)
        $dailyHarvest = DataPanen::whereIn('pemanen_id', $pemanenIds)
            ->selectRaw('DATE(created_at) as date, SUM(jumlah_buah_per_blok) as total')
            ->whereBetween('created_at', [now()->subDays(6), now()])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $dailyLabels = [];
        $dailyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dailyLabels[] = $date->format('d M');
            $dailyData[] = $dailyHarvest->get($date->format('Y-m-d'), 0);
        }

        // AKP Data
        $currentMonth = now()->format('Y-m');
        $planAKP = PlanAKP::where('mandor_id', $mandorId)
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])
            ->sum('total');
            
        $aktualAKP = AktualAKP::where('mandor_id', $mandorId)
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])
            ->sum('total');

        $achievementPercent = $planAKP > 0 ? ($aktualAKP / $planAKP) * 100 : 0;

        // Quality distribution for pie chart
        $qualityData = [
            'ripe' => $harvestSummary->total_ripe ?? 0,
            'over_ripe' => $harvestSummary->total_over_ripe ?? 0,
            'under_ripe' => $harvestSummary->total_under_ripe ?? 0,
            'eb' => $harvestSummary->total_eb ?? 0,
            'brondolan' => $harvestSummary->total_brondolan ?? 0
        ];

        // Attendance statistics
        $attendanceStats = [
            'hadir' => AbsensiPemanen::where('mandor_id', $mandorId)
                ->where('keterangan', 'P(Panen)')
                ->count(),
            'mangkir' => AbsensiPemanen::where('mandor_id', $mandorId)
                ->where('keterangan', 'M(Mangkir)')
                ->count(),
            'sakit' => AbsensiPemanen::where('mandor_id', $mandorId)
                ->where('keterangan', 'S(Sakit)')
                ->count(),
            'cuti' => AbsensiPemanen::where('mandor_id', $mandorId)
                ->where('keterangan', 'C(Cuti)')
                ->count(),
        ];

        $totalAttendanceRecords = array_sum($attendanceStats);
        $attendanceRate = $totalAttendanceRecords > 0 ? 
            ($attendanceStats['hadir'] / $totalAttendanceRecords) * 100 : 0;

        // Top performing pemanen
        $topPemanen = DataPanen::whereIn('pemanen_id', $pemanenIds)
            ->selectRaw('pemanen_id, SUM(jumlah_buah_per_blok) as total_harvest')
            ->groupBy('pemanen_id')
            ->orderBy('total_harvest', 'desc')
            ->with('pemanen')
            ->limit(5)
            ->get();

        // Compliance statistics
        $complianceStats = [
            'total_records' => GrafikKepatuhan::where('mandor_id', $mandorId)->count(),
            'good_compliance' => GrafikKepatuhan::where('mandor_id', $mandorId)
                ->where('alas_karung_brondol', 'Ya')
                ->where('panen_blok_17', 'Ya')
                ->count(),
        ];

        $complianceRate = $complianceStats['total_records'] > 0 ? 
            ($complianceStats['good_compliance'] / $complianceStats['total_records']) * 100 : 0;

        return view('pagemandor.dashboard.index', compact(
            'mandor',
            'totalPemanen',
            'totalDataPanen',
            'totalAbsensi',
            'totalAbsensiBerkala',
            'totalAbsensiPemanen',
            'totalGrafikKepatuhan',
            'todayHarvest',
            'thisWeekHarvest', 
            'thisMonthHarvest',
            'recentPemanen',
            'recentDataPanen',
            'recentAbsensi',
            'recentGrafikKepatuhan',
            'harvestSummary',
            'monthlyLabels',
            'monthlyData',
            'dailyLabels',
            'dailyData',
            'qualityData',
            'planAKP',
            'aktualAKP',
            'achievementPercent',
            'attendanceStats',
            'attendanceRate',
            'complianceStats',
            'complianceRate',
            'topPemanen'
        ));
    }
}
