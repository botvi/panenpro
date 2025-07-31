<?php

namespace App\Http\Controllers\asisten;

use App\Models\GrafikKepatuhan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GrafikKepatuhanController extends Controller
{
    /**
     * Display Grafik Kepatuhan data for asisten (read-only)
     */
    public function index(Request $request)
    {
        // Filter tanggal dari request
        $startDate = $request->get('start_date', now()->subDays(6)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));
        
        // Convert to Carbon instances for database queries
        $tanggalAwal = \Carbon\Carbon::parse($startDate)->startOfDay();
        $tanggalAkhir = \Carbon\Carbon::parse($endDate)->endOfDay();

        $grafikkepatuhan = GrafikKepatuhan::with(['pemanen', 'mandor'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->get();

        // GRAFIIK DISRIBUSI BUAH KELUAR 
        // Calculate percentages for distribusibuahkeluar
        $distribusibuahkeluar = GrafikKepatuhan::whereIn('keluar_buah', ['Kurang dari 9', 'Lebih dari 9'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->get();

        $totalRecords = $distribusibuahkeluar->count();
        $kurangDari9 = $distribusibuahkeluar->where('keluar_buah', 'Kurang dari 9')->count();
        $lebihDari9 = $distribusibuahkeluar->where('keluar_buah', 'Lebih dari 9')->count();

        // Hitung persentase distribusi buah keluar berdasarkan filter tanggal
        $dataDistribusi = GrafikKepatuhan::whereIn('keluar_buah', ['Kurang dari 9', 'Lebih dari 9'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('created_at', 'desc')
            ->get();

        // Kelompokkan data berdasarkan tanggal created_at (format Y-m-d)
        $grupTanggal = $dataDistribusi->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $persentasePerTanggalDistribusibuahkeluar = [];

        // Loop untuk semua tanggal dalam range filter
        $currentDate1 = $tanggalAwal->copy();
        while ($currentDate1 <= $tanggalAkhir) {
            $tanggal = $currentDate1->format('Y-m-d');
            $data = $grupTanggal->get($tanggal, collect());

            $totalPerTanggal = $data->count();
            $kurangDari9 = $data->where('keluar_buah', 'Kurang dari 9')->count();
            $lebihDari9 = $data->where('keluar_buah', 'Lebih dari 9')->count();

            $persentaseKurangDari9 = $totalPerTanggal > 0 ? round(($kurangDari9 / $totalPerTanggal) * 100, 1) : 0;
            $persentaseLebihDari9 = $totalPerTanggal > 0 ? round(($lebihDari9 / $totalPerTanggal) * 100, 1) : 0;

            $persentasePerTanggalDistribusibuahkeluar[$tanggal] = [
                'persentaseKurangDari9' => $persentaseKurangDari9,
                'persentaseLebihDari9' => $persentaseLebihDari9
            ];
            
            $currentDate1->addDay();
        }
        // GRAFIIK DISRIBUSI BUAH KELUAR 


        // DISTRIBUSI ALAS KARUNG BRONDOL
        // Calculate percentages for distribusibuahkeluar
        $distribusialaskarungbrondol = GrafikKepatuhan::whereIn('alas_karung_brondol', ['Ya', 'Tidak'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->get();

        $totalRecords = $distribusialaskarungbrondol->count();
        $ya = $distribusialaskarungbrondol->where('alas_karung_brondol', 'Ya')->count();
        $tidak = $distribusialaskarungbrondol->where('alas_karung_brondol', 'Tidak')->count();

        // Hitung persentase distribusi buah keluar berdasarkan filter tanggal
        $dataDistribusi = GrafikKepatuhan::whereIn('alas_karung_brondol', ['Ya', 'Tidak'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('created_at', 'desc')
            ->get();

        // Kelompokkan data berdasarkan tanggal created_at (format Y-m-d)
        $grupTanggal = $dataDistribusi->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $persentasePerTanggalAlasKarungBrondol = [];

        // Loop untuk semua tanggal dalam range filter
        $currentDate2 = $tanggalAwal->copy();
        while ($currentDate2 <= $tanggalAkhir) {
            $tanggal = $currentDate2->format('Y-m-d');
            $data = $grupTanggal->get($tanggal, collect());

            $totalPerTanggal = $data->count();
            $ya = $data->where('alas_karung_brondol', 'Ya')->count();
            $tidak = $data->where('alas_karung_brondol', 'Tidak')->count();

            $persentaseYa = $totalPerTanggal > 0 ? round(($ya / $totalPerTanggal) * 100, 1) : 0;
            $persentaseTidak = $totalPerTanggal > 0 ? round(($tidak / $totalPerTanggal) * 100, 1) : 0;

            $persentasePerTanggalAlasKarungBrondol[$tanggal] = [
                'persentaseYa' => $persentaseYa,
                'persentaseTidak' => $persentaseTidak
            ];
            
            $currentDate2->addDay();
        }
        // DISTRIBUSI ALAS KARUNG BRONDOL

        // DISTRIBUSI PANEN POKOK 17

        // Calculate percentages for distribusibuahkeluar
        $distribusipanenpokok17 = GrafikKepatuhan::whereIn('panen_blok_17', ['Ya', 'Tidak'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->get();

        $totalRecords = $distribusipanenpokok17->count();
        $ya = $distribusipanenpokok17->where('panen_blok_17', 'Ya')->count();
        $tidak = $distribusipanenpokok17->where('panen_blok_17', 'Tidak')->count();

        // Hitung persentase distribusi buah keluar berdasarkan filter tanggal
        $dataDistribusi = GrafikKepatuhan::whereIn('panen_blok_17', ['Ya', 'Tidak'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('created_at', 'desc')
            ->get();

        // Kelompokkan data berdasarkan tanggal created_at (format Y-m-d)
        $grupTanggal = $dataDistribusi->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $persentasePerTanggalPanenBlok17 = [];

        // Loop untuk semua tanggal dalam range filter
        $currentDate3 = $tanggalAwal->copy();
        while ($currentDate3 <= $tanggalAkhir) {
            $tanggal = $currentDate3->format('Y-m-d');
            $data = $grupTanggal->get($tanggal, collect());

            $totalPerTanggal = $data->count();
            $ya = $data->where('panen_blok_17', 'Ya')->count();
            $tidak = $data->where('panen_blok_17', 'Tidak')->count();

            $persentaseYa = $totalPerTanggal > 0 ? round(($ya / $totalPerTanggal) * 100, 1) : 0;
            $persentaseTidak = $totalPerTanggal > 0 ? round(($tidak / $totalPerTanggal) * 100, 1) : 0;

            $persentasePerTanggalPanenBlok17[$tanggal] = [
                'persentaseYa' => $persentaseYa,
                'persentaseTidak' => $persentaseTidak
            ];
            
            $currentDate3->addDay();
        }

        // DISTRIBUSI PANEN POKOK 17



        // DISTRIBUSI STAMPEL PANEN

        // Calculate percentages for distribusibuahkeluar
        $distribusistampelpanen = GrafikKepatuhan::whereIn('stampel_panen', ['Ya', 'Tidak'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->get();

        $totalRecords = $distribusistampelpanen->count();
        $ya = $distribusistampelpanen->where('stampel_panen', 'Ya')->count();
        $tidak = $distribusistampelpanen->where('stampel_panen', 'Tidak')->count();

        // Hitung persentase distribusi buah keluar berdasarkan filter tanggal
        $dataDistribusi = GrafikKepatuhan::whereIn('stampel_panen', ['Ya', 'Tidak'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('created_at', 'desc')
            ->get();

        // Kelompokkan data berdasarkan tanggal created_at (format Y-m-d)
        $grupTanggal = $dataDistribusi->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $persentasePerTanggalStampelPanen = [];

        // Loop untuk semua tanggal dalam range filter
        $currentDate4 = $tanggalAwal->copy();
        while ($currentDate4 <= $tanggalAkhir) {
            $tanggal = $currentDate4->format('Y-m-d');
            $data = $grupTanggal->get($tanggal, collect());

            $totalPerTanggal = $data->count();
            $ya = $data->where('stampel_panen', 'Ya')->count();
            $tidak = $data->where('stampel_panen', 'Tidak')->count();

            $persentaseYa = $totalPerTanggal > 0 ? round(($ya / $totalPerTanggal) * 100, 1) : 0;
            $persentaseTidak = $totalPerTanggal > 0 ? round(($tidak / $totalPerTanggal) * 100, 1) : 0;

            $persentasePerTanggalStampelPanen[$tanggal] = [
                'persentaseYa' => $persentaseYa,
                'persentaseTidak' => $persentaseTidak
            ];
            
            $currentDate4->addDay();
        }

        // DISTRIBUSI STAMPEL PANEN
        return view('pageasisten.grafik_kepatuhan.index', compact(
            'grafikkepatuhan',
            'distribusibuahkeluar',
            'persentasePerTanggalDistribusibuahkeluar',
            'distribusialaskarungbrondol',
            'persentasePerTanggalAlasKarungBrondol',
            'persentasePerTanggalPanenBlok17',
            'persentasePerTanggalStampelPanen',
            'startDate',
            'endDate'
        ));
    }
}
