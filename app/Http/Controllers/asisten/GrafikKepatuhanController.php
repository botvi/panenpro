<?php

namespace App\Http\Controllers\asisten;

use App\Models\GrafikKepatuhan;
use App\Models\Mandor;
use App\Models\Pemanen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GrafikKepatuhanController extends Controller
{
    /**
     * Display Grafik Kepatuhan data for asisten (read-only)
     */
    public function index()
    {
        // Load grafik kepatuhan with relationships
        $grafikkepatuhan = GrafikKepatuhan::with(['pemanen', 'mandor'])->get();
        
        // Get all mandors and pemanens for filter dropdown
        $mandors = Mandor::all();
        $pemanens = Pemanen::all();

        // Map the data to include proper relationships for JavaScript
        $grafikkepatuhan = $grafikkepatuhan->map(function ($item) {
            return [
                'id' => $item->id,
                'pemanen_id' => $item->pemanen_id,
                'mandor_id' => $item->mandor_id,
                'keluar_buah' => $item->keluar_buah,
                'alas_karung_brondol' => $item->alas_karung_brondol,
                'panen_blok_17' => $item->panen_blok_17,
                'tanggal' => $item->tanggal,
                'created_at' => $item->created_at,
                'pemanen' => $item->pemanen ? [
                    'id' => $item->pemanen->id,
                    'nama' => $item->pemanen->nama ?? 'N/A'
                ] : null,
                'mandor' => $item->mandor ? [
                    'id' => $item->mandor->id,
                    'nama' => $item->mandor->nama ?? 'N/A'
                ] : null
            ];
        });


        // GRAFIIK DISRIBUSI BUAH KELUAR 
        // Calculate percentages for distribusibuahkeluar
        $distribusibuahkeluar = GrafikKepatuhan::whereIn('keluar_buah', ['Kurang dari 9', 'Lebih dari 9'])->get();

        $totalRecords = $distribusibuahkeluar->count();
        $kurangDari9 = $distribusibuahkeluar->where('keluar_buah', 'Kurang dari 9')->count();
        $lebihDari9 = $distribusibuahkeluar->where('keluar_buah', 'Lebih dari 9')->count();

        // Hitung persentase distribusi buah keluar untuk 7 hari terakhir dari tanggal saat ini
        $tanggalAkhir = now()->endOfDay();
        $tanggalAwal = now()->subDays(6)->startOfDay();

        $dataDistribusi = GrafikKepatuhan::whereIn('keluar_buah', ['Kurang dari 9', 'Lebih dari 9'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('created_at', 'desc')
            ->get();

        // Kelompokkan data berdasarkan tanggal created_at (format Y-m-d)
        $grupTanggal = $dataDistribusi->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $persentasePerTanggalDistribusibuahkeluar = [];

        // Loop untuk 7 hari terakhir, walaupun tidak ada data tetap tampilkan 0
        for ($i = 0; $i < 7; $i++) {
            $tanggal = now()->subDays(6 - $i)->format('Y-m-d');
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
        }
        // GRAFIIK DISRIBUSI BUAH KELUAR 


        // DISTRIBUSI ALAS KARUNG BRONDOL
        // Calculate percentages for distribusibuahkeluar
        $distribusialaskarungbrondol = GrafikKepatuhan::whereIn('alas_karung_brondol', ['Ya', 'Tidak'])->get();

        $totalRecords = $distribusialaskarungbrondol->count();
        $ya = $distribusialaskarungbrondol->where('alas_karung_brondol', 'Ya')->count();
        $tidak = $distribusialaskarungbrondol->where('alas_karung_brondol', 'Tidak')->count();

        // Hitung persentase distribusi buah keluar untuk 7 hari terakhir dari tanggal saat ini
        $tanggalAkhir = now()->endOfDay();
        $tanggalAwal = now()->subDays(6)->startOfDay();

        $dataDistribusi = GrafikKepatuhan::whereIn('alas_karung_brondol', ['Ya', 'Tidak'])
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('created_at', 'desc')
            ->get();

        // Kelompokkan data berdasarkan tanggal created_at (format Y-m-d)
        $grupTanggal = $dataDistribusi->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $persentasePerTanggalAlasKarungBrondol = [];

        // Loop untuk 7 hari terakhir, walaupun tidak ada data tetap tampilkan 0
        for ($i = 0; $i < 7; $i++) {
            $tanggal = now()->subDays(6 - $i)->format('Y-m-d');
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
        }
        // DISTRIBUSI ALAS KARUNG BRONDOL

        // DISTRIBUSI PANEN POKOK 17
        
                // Calculate percentages for distribusibuahkeluar
                $distribusipanenpokok17 = GrafikKepatuhan::whereIn('panen_blok_17', ['Ya', 'Tidak'])->get();

                $totalRecords = $distribusipanenpokok17->count();
                $ya = $distribusipanenpokok17->where('panen_blok_17', 'Ya')->count();
                $tidak = $distribusipanenpokok17->where('panen_blok_17', 'Tidak')->count();
        
                // Hitung persentase distribusi buah keluar untuk 7 hari terakhir dari tanggal saat ini
                $tanggalAkhir = now()->endOfDay();
                $tanggalAwal = now()->subDays(6)->startOfDay();
        
                $dataDistribusi = GrafikKepatuhan::whereIn('panen_blok_17', ['Ya', 'Tidak'])
                    ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
                    ->orderBy('created_at', 'desc')
                    ->get();
        
                // Kelompokkan data berdasarkan tanggal created_at (format Y-m-d)
                $grupTanggal = $dataDistribusi->groupBy(function ($item) {
                    return $item->created_at->format('Y-m-d');
                });
        
                $persentasePerTanggalPanenBlok17 = [];
        
                // Loop untuk 7 hari terakhir, walaupun tidak ada data tetap tampilkan 0
                for ($i = 0; $i < 7; $i++) {
                    $tanggal = now()->subDays(6 - $i)->format('Y-m-d');
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
                }
        
                // DISTRIBUSI PANEN POKOK 17
        return view('pageasisten.grafik_kepatuhan.index', compact(
            'grafikkepatuhan',
            'mandors',
            'pemanens',
            'distribusibuahkeluar',
            'persentasePerTanggalDistribusibuahkeluar',
            'distribusialaskarungbrondol',
            'persentasePerTanggalAlasKarungBrondol',
            'persentasePerTanggalPanenBlok17'
        ));
    }
}
