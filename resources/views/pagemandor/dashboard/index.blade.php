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
                                <h5 class="m-b-10">Dashboard Mandor</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard-mandor') }}">Home</a></li>
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
                @if ($mandor)
                    <div class="col-md-12">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="text-white mb-2">Selamat datang,
                                            {{ $mandor->nama ?? $mandor->username }}!</h4>
                                        <p class="text-white-50 mb-0">
                                            <i class="ti ti-calendar me-2"></i>{{ now()->format('l, d F Y') }}
                                        </p>
                                        <p class="text-white-50 mb-0">
                                            <i class="ti ti-users me-2"></i>Tim Anda: {{ $totalPemanen }} Pemanen
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

                <!-- Quick Stats Cards -->
                <div class="col-md-6 col-xl-12">
                    <div class="card stat-card hover-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="f-w-400 mb-0 animate-counter">{{ $totalPemanen }}</h4>
                                    <span class="d-block text-uppercase text-muted f-10 f-w-400 mt-1">
                                        Total Pemanen
                                    </span>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="avtar avtar-s bg-light-primary">
                                        <i class="ti ti-users f-18"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-gradient">
                            <h5 class="mb-0">
                                <i class="ti ti-bolt me-2"></i>Aksi Cepat
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6 col-xl-3">
                                    <a href="{{ route('datapemanen.create') }}"
                                        class="btn btn-light-primary w-100 py-3 hover-effect">
                                        <i class="ti ti-user-plus f-20 mb-2 d-block"></i>
                                        <div class="fw-bold">Tambah Pemanen</div>
                                        <small class="text-muted">Registrasi anggota tim baru</small>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <a href="{{ route('planakp.create') }}"
                                        class="btn btn-light-success w-100 py-3 hover-effect">
                                        <i class="ti ti-target f-20 mb-2 d-block"></i>
                                        <div class="fw-bold">Set Target AKP</div>
                                        <small class="text-muted">Tetapkan target panen bulanan</small>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <a href="{{ route('absensipemanen.create') }}"
                                        class="btn btn-light-warning w-100 py-3 hover-effect">
                                        <i class="ti ti-calendar-event f-20 mb-2 d-block"></i>
                                        <div class="fw-bold">Input Absensi</div>
                                        <small class="text-muted">Catat kehadiran tim</small>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <a href="{{ route('grafikkepatuhan.create') }}"
                                        class="btn btn-light-info w-100 py-3 hover-effect">
                                        <i class="ti ti-chart-line f-20 mb-2 d-block"></i>
                                        <div class="fw-bold">Monitor Kepatuhan</div>
                                        <small class="text-muted">Evaluasi kepatuhan SOP</small>
                                    </a>
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
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
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
        }

        .chart-container {
            position: relative;
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
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        .animate-counter {
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: countUp 2s ease-out;
            font-weight: 700;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-box {
            padding: 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
        }

        .progress {
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            transition: width 1.5s ease-in-out;
        }

        .card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
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
        }

        .btn-light-primary:hover,
        .btn-light-success:hover,
        .btn-light-warning:hover,
        .btn-light-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // AKP Progress Chart
            @if ($planAKP > 0)
                const akpCtx = document.getElementById('akpProgressChart');
                if (akpCtx) {
                    new Chart(akpCtx, {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                data: [{{ $aktualAKP }}, {{ max(0, $planAKP - $aktualAKP) }}],
                                backgroundColor: [
                                    @if ($achievementPercent >= 100)
                                        '#28a745'
                                    @elseif ($achievementPercent >= 80)
                                        '#ffc107'
                                    @else
                                        '#dc3545'
                                    @endif ,
                                    '#e9ecef'
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                }
            @endif

            // Monthly Harvest Chart
            @if (isset($monthlyLabels) && array_sum($monthlyData) > 0)
                const monthlyCtx = document.getElementById('monthlyHarvestChart');
                if (monthlyCtx) {
                    new Chart(monthlyCtx, {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($monthlyLabels) !!},
                            datasets: [{
                                label: 'Jumlah Buah',
                                data: {!! json_encode($monthlyData) !!},
                                borderColor: '#28a745',
                                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#28a745',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f1f1f1'
                                    },
                                    ticks: {
                                        callback: function(value) {
                                            return value.toLocaleString();
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            }
                        }
                    });
                }
            @endif

            // Daily Trend Chart
            @if (isset($dailyLabels) && array_sum($dailyData) > 0)
                const dailyCtx = document.getElementById('dailyTrendChart');
                if (dailyCtx) {
                    new Chart(dailyCtx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($dailyLabels) !!},
                            datasets: [{
                                label: 'Panen Harian',
                                data: {!! json_encode($dailyData) !!},
                                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                                borderColor: '#36a2eb',
                                borderWidth: 1,
                                borderRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f1f1f1'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }
            @endif

            // Quality Distribution Chart
            @if (isset($qualityData) && array_sum($qualityData) > 0)
                const qualityCtx = document.getElementById('qualityChart');
                if (qualityCtx) {
                    new Chart(qualityCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Ripe', 'Over Ripe', 'Under Ripe', 'EB', 'Brondolan'],
                            datasets: [{
                                data: [
                                    {{ $qualityData['ripe'] }},
                                    {{ $qualityData['over_ripe'] }},
                                    {{ $qualityData['under_ripe'] }},
                                    {{ $qualityData['eb'] }},
                                    {{ $qualityData['brondolan'] }}
                                ],
                                backgroundColor: [
                                    '#28a745',
                                    '#dc3545',
                                    '#ffc107',
                                    '#6f42c1',
                                    '#17a2b8'
                                ],
                                borderWidth: 2,
                                borderColor: '#fff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                }
            @endif

            // Counter animation
            function animateValue(element, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    const currentValue = Math.floor(progress * (end - start) + start);
                    element.innerHTML = currentValue.toLocaleString();
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            // Animate counters
            document.querySelectorAll('.animate-counter').forEach(counter => {
                const target = parseInt(counter.textContent.replace(/,/g, ''));
                animateValue(counter, 0, target, 2000);
            });
        });
    </script>
@endpush
