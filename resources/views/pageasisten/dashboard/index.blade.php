@extends('template-admin.layout')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard Asisten</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard-asisten') }}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Welcome Card -->
                @if ($asisten)
                    <div class="col-md-12">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="text-white mb-2">Selamat datang, {{ $asisten->name ?? $asisten->username }}!</h4>
                                        <p class="text-white-50 mb-0">
                                            <i class="ti ti-calendar me-2"></i>{{ now()->format('l, d F Y') }}
                                        </p>
                                        <p class="text-white-50 mb-0">
                                            <i class="ti ti-users me-2"></i>Tim Anda: {{ $totalMandor }} Mandor, {{ $totalPemanen }} Pemanen
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="ti ti-user-circle f-60 text-white-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Statistics Cards -->
                <div class="col-md-6 col-xl-3">
                    <div class="card stat-card hover-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="mb-2 f-w-400 text-muted">Total Mandor</h6>
                                    <h4 class="mb-0 animate-counter">{{ $totalMandor }}</h4>
                                    <p class="mb-0 text-muted text-sm">
                                        <i class="ti ti-trending-up text-success me-1"></i>
                                        Mandor terdaftar
                                    </p>
                                </div>
                                <div class="avtar avtar-l bg-light-primary">
                                    <i class="ti ti-user f-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card stat-card hover-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="mb-2 f-w-400 text-muted">Total Pemanen</h6>
                                    <h4 class="mb-0 animate-counter">{{ $totalPemanen }}</h4>
                                    <p class="mb-0 text-muted text-sm">
                                        <i class="ti ti-users text-success me-1"></i>
                                        Pemanen aktif
                                    </p>
                                </div>
                                <div class="avtar avtar-l bg-light-success">
                                    <i class="ti ti-users f-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card stat-card hover-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="mb-2 f-w-400 text-muted">Total Data Panen</h6>
                                    <h4 class="mb-0 animate-counter">{{ $totalDataPanen }}</h4>
                                    <p class="mb-0 text-muted text-sm">
                                        <i class="ti ti-chart-bar text-warning me-1"></i>
                                        Record tercatat
                                    </p>
                                </div>
                                <div class="avtar avtar-l bg-light-warning">
                                    <i class="ti ti-plant f-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card stat-card hover-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="mb-2 f-w-400 text-muted">Total Absensi</h6>
                                    <h4 class="mb-0 animate-counter">{{ $totalAbsensi }}</h4>
                                    <p class="mb-0 text-muted text-sm">
                                        <i class="ti ti-calendar-check text-info me-1"></i>
                                        Data kehadiran
                                    </p>
                                </div>
                                <div class="avtar avtar-l bg-light-info">
                                    <i class="ti ti-calendar f-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Recent Harvest Data -->
                <div class="col-md-12 col-xl-12">
                    <div class="card hover-effect">
                        <div class="card-header card-header-gradient d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                <i class="ti ti-clipboard-list me-2"></i>Data Panen Terbaru
                            </h5>
                            @if(Route::has('asisten.datapanen.index'))
                                <a href="{{ route('asisten.datapanen.index') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-eye me-1"></i>Lihat Semua
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Pemanen</th>
                                            <th>Blok</th>
                                            <th>Ripe</th>
                                            <th>Overripe</th>
                                            <th>Underripe</th>
                                            <th>eb</th>
                                            <th>Brondolan</th>
                                            <th>Total Buah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentDataPanen as $data)
                                            <tr>
                                                <td>
                                                    <small class="text-muted">{{ $data->created_at->format('d/m/Y') }}</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avtar avtar-xs bg-light-success me-2">
                                                            <i class="ti ti-user f-14"></i>
                                                        </div>
                                                        <span class="text-truncate">{{ $data->pemanen->nama ?? 'N/A' }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-primary">{{ $data->nama_blok }}</span>
                                                </td>
                                              
                                                <td>
                                                    <span class="badge bg-light-success">{{ number_format($data->ripe) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-success">{{ number_format($data->over_ripe) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-success">{{ number_format($data->under_ripe) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-success">{{ number_format($data->eb) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-success">{{ number_format($data->brondolan  ) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-success">{{ number_format($data->jumlah_buah_per_blok) }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    <i class="ti ti-inbox f-40 mb-2"></i>
                                                    <br>Belum ada data panen terbaru
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Mandor -->
                <div class="col-md-12 col-xl-6">
                    <div class="card hover-effect">
                        <div class="card-header card-header-gradient d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                <i class="ti ti-user-check me-2"></i>Mandor Terbaru
                            </h5>
                            @if(Route::has('datamandor.index'))
                                <a href="{{ route('datamandor.index') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-eye me-1"></i>Lihat Semua
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            @forelse($recentMandor as $mandor)
                                <div class="d-flex align-items-center mb-3 p-2 rounded hover-effect">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s bg-light-primary">
                                            <i class="ti ti-user f-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ $mandor->nama }}</h6>
                                        <p class="text-muted mb-0 small">
                                            <i class="ti ti-id me-1"></i>NPK: {{ $mandor->npk }}
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <span class="badge bg-light-success">Aktif</span>
                                        <small class="text-muted d-block">{{ $mandor->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-4">
                                    <i class="ti ti-user-plus f-40 mb-3 opacity-50"></i>
                                    <h6 class="mb-1">Belum ada data mandor</h6>
                                    <p class="mb-0 small">Data mandor akan muncul setelah ada pendaftaran</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Pemanen -->
                <div class="col-md-12 col-xl-6">
                    <div class="card hover-effect">
                        <div class="card-header card-header-gradient d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                <i class="ti ti-users me-2"></i>Pemanen Terbaru
                            </h5>
                            @if(Route::has('datapemanen.index'))
                                <a href="{{ route('datapemanen.index') }}" class="btn btn-sm btn-outline-success">
                                    <i class="ti ti-eye me-1"></i>Lihat Semua
                                </a>
                            @else
                                <button class="btn btn-sm btn-outline-success" onclick="viewAllPemanen()">
                                    <i class="ti ti-eye me-1"></i>Lihat Semua
                                </button>
                            @endif
                        </div>
                        <div class="card-body">
                            @forelse($recentPemanen as $pemanen)
                                <div class="list-group-item border-0 px-0 py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-success">
                                                <i class="ti ti-user f-18"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ $pemanen->nama }}</h6>
                                            <p class="mb-0 text-muted small">
                                                <i class="ti ti-map-pin me-1"></i>{{ $pemanen->estate }} - {{ $pemanen->kode_panen }}
                                            </p>
                                            <small class="text-muted">
                                                <i class="ti ti-id me-1"></i>NPK: {{ $pemanen->npk }}
                                            </small>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <span class="badge bg-light-info">Aktif</span>
                                            <small class="text-muted d-block">{{ $pemanen->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-4">
                                    <i class="ti ti-users f-40 mb-3 opacity-50"></i>
                                    <h6 class="mb-1">Belum ada data pemanen</h6>
                                    <p class="mb-0 small">Data pemanen akan muncul setelah ada pendaftaran</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
        </div>
    </div>

                <!-- Quick Actions -->
                <div class="col-md-12">
                    <div class="card hover-effect">
                        <div class="card-header card-header-gradient">
                            <h5 class="mb-0">
                                <i class="ti ti-lightning me-2"></i>Aksi Cepat
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @if(Route::has('datamandor.create'))
                                    <div class="col-md-3">
                                        <a href="{{ route('datamandor.create') }}" class="btn btn-primary w-100 hover-effect">
                                            <i class="ti ti-plus me-2"></i>Tambah Mandor
                                        </a>
                                    </div>
                                @endif
                                @if(Route::has('asisten.akp.index'))
                                    <div class="col-md-3">
                                        <a href="{{ route('asisten.akp.index') }}" class="btn btn-info w-100 hover-effect">
                                            <i class="ti ti-clipboard-list me-2"></i>Kelola AKP
                                        </a>
                                    </div>
                                @endif
                                @if(Route::has('asisten.grafikkepatuhan.index'))
                                    <div class="col-md-3">
                                        <a href="{{ route('asisten.grafikkepatuhan.index') }}" class="btn btn-warning w-100 hover-effect">
                                            <i class="ti ti-activity me-2"></i>Grafik Kepatuhan
                                        </a>
                                    </div>
                                @endif
                                @if(Route::has('asisten.absensipemanen.index'))
                                    <div class="col-md-3">
                                        <a href="{{ route('asisten.absensipemanen.index') }}" class="btn btn-success w-100 hover-effect">
                                            <i class="ti ti-calendar-event me-2"></i>Absensi Pemanen
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="row g-3 mt-2">
                                @if(Route::has('asisten.absensiberkala.index'))
                                    <div class="col-md-6">
                                        <a href="{{ route('asisten.absensiberkala.index') }}" class="btn btn-secondary w-100 hover-effect">
                                            <i class="ti ti-calendar-event me-2"></i>Absensi Berkala
                                        </a>
                                    </div>
                                @endif
                                @if(Route::has('datamandor.index'))
                                    <div class="col-md-6">
                                        <a href="{{ route('datamandor.index') }}" class="btn btn-outline-primary w-100 hover-effect">
                                            <i class="ti ti-list me-2"></i>Data Mandor
                                        </a>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Statistics -->
                <div class="col-md-12">
                    <div class="card hover-effect">
                        <div class="card-header card-header-gradient">
                            <h5 class="mb-0">
                                <i class="ti ti-chart-dots me-2"></i>Statistik Tambahan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="stat-box">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h6 class="mb-2 f-w-400 text-muted">Data Kepatuhan</h6>
                                                <h4 class="mb-0 animate-counter">{{ $totalGrafikKepatuhan ?? 0 }}</h4>
                                                <p class="mb-0 text-muted text-sm">
                                                    <i class="ti ti-trending-up text-success me-1"></i>
                                                    Record kepatuhan
                                                </p>
                                            </div>
                                            <div class="avtar avtar-s bg-light-success">
                                                <i class="ti ti-chart-bar f-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="stat-box">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h6 class="mb-2 f-w-400 text-muted">Target AKP</h6>
                                                <h4 class="mb-0 animate-counter">{{ number_format($planAKP ?? 0) }}</h4>
                                                <p class="mb-0 text-muted text-sm">
                                                    <i class="ti ti-target text-primary me-1"></i>
                                                    Target ditetapkan
                                                </p>
                                            </div>
                                            <div class="avtar avtar-s bg-light-primary">
                                                <i class="ti ti-target f-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="stat-box">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h6 class="mb-2 f-w-400 text-muted">Realisasi AKP</h6>
                                                <h4 class="mb-0 animate-counter">{{ number_format($aktualAKP ?? 0) }}</h4>
                                                <p class="mb-0 text-muted text-sm">
                                                    <i class="ti ti-check text-success me-1"></i>
                                                    Sudah tercapai
                                                </p>
                                            </div>
                                            <div class="avtar avtar-s bg-light-warning">
                                                <i class="ti ti-check f-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="stat-box">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <h6 class="mb-2 f-w-400 text-muted">Efisiensi AKP</h6>
                                                <h4 class="mb-0 animate-counter">
                                                    @if(isset($planAKP) && $planAKP > 0)
                                                        {{ number_format((($aktualAKP ?? 0) / $planAKP) * 100, 1) }}%
                                                    @else
                                                        0%
                                                    @endif
                                                </h4>
                                                <p class="mb-0 text-muted text-sm">
                                                    <i class="ti ti-percentage text-info me-1"></i>
                                                    Tingkat pencapaian
                                                </p>
                                            </div>
                                            <div class="avtar avtar-s bg-light-info">
                                                <i class="ti ti-percentage f-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection

@push('styles')
<style>
    .hover-card {
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .stat-card .avtar {
        transition: all 0.3s ease;
    }
    
    .stat-card:hover .avtar {
        transform: scale(1.1);
    }
    
    .welcome-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
        border-radius: 10px;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    }
    
    .chart-container {
        position: relative;
        height: 300px;
    }
    
    .quality-legend {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 15px;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
    }
    
    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }
    
    .animate-counter {
        animation: countUp 2s ease-out;
        font-weight: 700;
    }
    
    @keyframes countUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .card-header-gradient {
        background: linear-gradient(90deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 1px solid #dee2e6;
    }
    
    .hover-effect {
        transition: all 0.3s ease;
    }
    
    .hover-effect:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .stat-box {
        padding: 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        background-color: rgba(248, 249, 250, 0.5);
    }
    
    .stat-box:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }

    .progress {
        border-radius: 10px;
        overflow: hidden;
        height: 10px;
    }

    .progress-bar {
        transition: width 1.5s ease-in-out;
    }

    .card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }

    .list-group-item {
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 1px solid #eee;
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .badge {
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.05);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }
    
    .avtar {
        transition: all 0.3s ease;
    }
    
    .avtar:hover {
        transform: scale(1.05);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .col-xl-3 {
            margin-bottom: 1rem;
        }
        
        .chart-container {
            height: 250px;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .quality-legend {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .stat-box {
            padding: 10px;
            text-align: center;
        }
        
        .btn-group-vertical .btn {
            margin-bottom: 0.5rem;
        }
        
        .welcome-gradient .col-auto {
            display: none;
        }
        
        .page-header .col-md-4 {
            margin-top: 1rem;
        }
        
        .dropdown {
            position: static !important;
        }
    }
    
    @media (max-width: 576px) {
        .page-header-title h5 {
            font-size: 1.2rem;
        }
        
        .card-header h5 {
            font-size: 1rem;
        }
        
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .btn {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
        
        .stat-box h4 {
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 1rem 0.75rem;
        }
        
        .row.g-3 {
            --bs-gutter-x: 0.5rem;
        }
        
        .col-md-3 {
            margin-bottom: 0.5rem;
        }
    }
    
    /* Button ripple effect */
    .btn {
        position: relative;
        overflow: hidden;
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 600ms linear;
        background-color: rgba(255, 255, 255, 0.7);
        pointer-events: none;
    }
    
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    /* Scroll animations */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Loading spinner for charts */
    .chart-loading {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 300px;
    }
    
    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .card {
            background-color: #1f2937;
            border-color: #374151;
        }
        
        .text-muted {
            color: #9ca3af !important;
        }
        
        .bg-light {
            background-color: #374151 !important;
        }
        
        .card-header-gradient {
            background: linear-gradient(90deg, #374151 0%, #4b5563 100%);
        }
    }
    
    /* Enhanced hover effects */
    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.5s;
    }
    
    .stat-card:hover::before {
        left: 100%;
    }
</style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Global Chart configuration
        Chart.defaults.responsive = true;
        Chart.defaults.maintainAspectRatio = false;
        Chart.defaults.plugins.legend.display = true;
        Chart.defaults.plugins.legend.position = 'bottom';

        // Dummy data generators
        function generateDummyData(type) {
            let dummyData = {};
            
            if (type === 'monthly') {
                dummyData = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    data: [1200, 1900, 3000, 5000, 2000, 3000, 4500, 3200, 2800, 4100, 3600, 2900]
                };
                createMonthlyChart(dummyData.labels, dummyData.data);
            } else if (type === 'daily') {
                dummyData = {
                    labels: [],
                    data: []
                };
                for (let i = 29; i >= 0; i--) {
                    const date = new Date();
                    date.setDate(date.getDate() - i);
                    dummyData.labels.push(date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' }));
                    dummyData.data.push(Math.floor(Math.random() * 500) + 100);
                }
                createDailyChart(dummyData.labels, dummyData.data);
            } else if (type === 'quality') {
                dummyData = {
                    labels: ['Ripe', 'Over Ripe', 'Under Ripe', 'Empty Bunch', 'Brondolan'],
                    data: [2500, 800, 400, 200, 600]
                };
                createQualityChart(dummyData.labels, dummyData.data);
            }
            
            // Hide the empty state and show chart
            const emptyState = event.target.closest('.card-body').querySelector('.text-center.text-muted');
            if (emptyState) {
                emptyState.style.display = 'none';
            }
        }

        function createMonthlyChart(labels, data) {
            const monthlyCtx = document.getElementById('monthlyHarvestChart');
            if (monthlyCtx) {
                // Clear existing chart
                Chart.getChart(monthlyCtx)?.destroy();
                
                new Chart(monthlyCtx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Buah',
                            data: data,
                            borderColor: '#4f46e5',
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            tension: 0.4,
                            fill: true,
                            borderWidth: 3,
                            pointBackgroundColor: '#4f46e5',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 6,
                            pointHoverRadius: 8
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Produksi Panen Bulanan {{ date('Y') }}',
                                font: { size: 16, weight: 'bold' },
                                color: '#374151'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
                
                // Show statistics if hidden
                const statsContainer = document.querySelector('.chart-container').nextElementSibling;
                if (statsContainer && statsContainer.classList.contains('row')) {
                    statsContainer.style.display = 'flex';
                }
            }
        }

        function createDailyChart(labels, data) {
            const dailyCtx = document.getElementById('dailyTrendChart');
            if (dailyCtx) {
                Chart.getChart(dailyCtx)?.destroy();
                
                new Chart(dailyCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Harvest Harian',
                            data: data,
                            backgroundColor: 'rgba(34, 197, 94, 0.8)',
                            borderColor: 'rgba(34, 197, 94, 1)',
                            borderWidth: 1,
                            borderRadius: 6,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Tren Harvest Harian (30 Hari Terakhir)'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            }
        }

        function createQualityChart(labels, data) {
            const qualityCtx = document.getElementById('qualityChart');
            if (qualityCtx) {
                Chart.getChart(qualityCtx)?.destroy();
                
                new Chart(qualityCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Buah',
                            data: data,
                            backgroundColor: [
                                '#28a745',
                                '#ffc107',
                                '#dc3545',
                                '#6c757d',
                                '#17a2b8'
                            ],
                            borderRadius: 6,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        plugins: {
                            legend: { display: false },
                            title: {
                                display: true,
                                text: 'Distribusi Kualitas Buah'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
                
                // Update legend
                const legend = document.querySelector('.quality-legend');
                if (legend) {
                    legend.innerHTML = `
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #28a745;"></div>
                            <span class="text-sm">Ripe (${data[0].toLocaleString()})</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #ffc107;"></div>
                            <span class="text-sm">Over Ripe (${data[1].toLocaleString()})</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #dc3545;"></div>
                            <span class="text-sm">Under Ripe (${data[2].toLocaleString()})</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #6c757d;"></div>
                            <span class="text-sm">Empty Bunch (${data[3].toLocaleString()})</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #17a2b8;"></div>
                            <span class="text-sm">Brondolan (${data[4].toLocaleString()})</span>
                        </div>
                    `;
                    legend.style.display = 'flex';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Monthly Harvest Chart
            @if(isset($monthlyData) && is_array($monthlyData) && array_sum($monthlyData) > 0)
                createMonthlyChart({!! json_encode($monthlyLabels) !!}, {!! json_encode($monthlyData) !!});
            @endif

            // Daily Trend Chart
            @if(isset($dailyData) && is_array($dailyData) && array_sum($dailyData) > 0)
                createDailyChart({!! json_encode($dailyLabels) !!}, {!! json_encode($dailyData) !!});
            @endif

            // AKP Donut Chart
            @if ($planAKP > 0)
                const akpCtx = document.getElementById('akpDonutChart');
                if (akpCtx) {
                    const akpPercentage = {{ ($aktualAKP / $planAKP) * 100 }};

                    new Chart(akpCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Tercapai', 'Sisa Target'],
                            datasets: [{
                                data: [{{ $aktualAKP }}, {{ $planAKP - $aktualAKP }}],
                                backgroundColor: [
                                    akpPercentage >= 80 ? '#28a745' : akpPercentage >= 60 ? '#ffc107' : '#dc3545',
                                    '#e9ecef'
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            cutout: '70%'
                        }
                    });
                }
            @endif

            // Quality Distribution Chart
            @if (isset($harvestSummary) && $harvestSummary && $harvestSummary->total_buah > 0)
                createQualityChart(
                    ['Ripe', 'Over Ripe', 'Under Ripe', 'Empty Bunch', 'Brondolan'],
                    [
                        {{ $qualityData['ripe'] ?? 0 }},
                        {{ $qualityData['over_ripe'] ?? 0 }},
                        {{ $qualityData['under_ripe'] ?? 0 }},
                        {{ $qualityData['eb'] ?? 0 }},
                        {{ $qualityData['brondolan'] ?? 0 }}
                    ]
                );
            @endif
        });

        // Utility functions
        function refreshDashboard() {
            location.reload();
        }

        function fullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        }

        function viewAllPemanen() {
            // Placeholder function for viewing all pemanen
            alert('Fitur ini akan mengarahkan ke halaman data pemanen');
        }

        function exportData() {
            const csvContent = "data:text/csv;charset=utf-8," 
                + "Type,Value\n"
                + "Total Mandor,{{ $totalMandor }}\n"
                + "Total Pemanen,{{ $totalPemanen }}\n"
                + "Total Data Panen,{{ $totalDataPanen }}\n"
                + "Total Absensi,{{ $totalAbsensi }}\n"
                + "Plan AKP,{{ $planAKP }}\n"
                + "Aktual AKP,{{ $aktualAKP }}\n";
            
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "dashboard_asisten_{{ date('Y-m-d') }}.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Show success message
            setTimeout(() => {
                alert('Data berhasil diexport!');
            }, 100);
        }

        // Counter animation for statistics
        function animateCounter(element, target, duration = 2000) {
            let current = 0;
            const increment = target / (duration / 16);
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    clearInterval(timer);
                    current = target;
                }
                element.textContent = Math.floor(current).toLocaleString();
            }, 16);
        }

        // Initialize counter animations
        document.querySelectorAll('.animate-counter').forEach(counter => {
            const target = parseInt(counter.textContent.replace(/,/g, ''));
            if (!isNaN(target)) {
                counter.textContent = '0';
                setTimeout(() => animateCounter(counter, target), 500);
            }
        });

        // Add loading animation to cards
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Add click effects to buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                this.appendChild(ripple);
                
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>
@endpush
