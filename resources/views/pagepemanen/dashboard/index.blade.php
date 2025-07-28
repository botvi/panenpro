@extends('template-admin.layout')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard Pemanen</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
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
                @if ($pemanen)
                    <div class="col-md-12">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="text-white mb-2">Selamat datang, {{ $pemanen->nama }}!</h4>
                                        <p class="text-white-50 mb-0">Estate: {{ $pemanen->estate }} | Kode:
                                            {{ $pemanen->kode_panen }} | NPK: {{ $pemanen->npk }}</p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="ti ti-user-circle f-60 text-white-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



                <!-- Quick Actions -->
                <div class="col-md-12">
                    <h5 class="mb-3">Aksi Cepat</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <a href="{{ route('datapanen.create') }}" class="btn btn-primary w-100 py-3">
                                        <i class="ti ti-plus f-20 mb-2"></i>
                                        <div>Tambah Data Panen</div>
                                        <small class="text-white-50">Input data panen baru</small>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('datapanen.index') }}" class="btn btn-outline-primary w-100 py-3">
                                        <i class="ti ti-list f-20 mb-2"></i>
                                        <div>Lihat Semua Data</div>
                                        <small class="text-muted">Riwayat panen lengkap</small>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-outline-success w-100 py-3" onclick="window.print()">
                                        <i class="ti ti-printer f-20 mb-2"></i>
                                        <div>Cetak Laporan</div>
                                        <small class="text-muted">Print dashboard ini</small>
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-outline-info w-100 py-3" onclick="refreshDashboard()">
                                        <i class="ti ti-refresh f-20 mb-2"></i>
                                        <div>Refresh Data</div>
                                        <small class="text-muted">Perbarui dashboard</small>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Monthly Harvest Trend Chart
            const monthlyTrendCtx = document.getElementById('monthlyTrendChart').getContext('2d');
            new Chart(monthlyTrendCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($monthlyLabels) !!},
                    datasets: [{
                        label: 'Total Buah',
                        data: {!! json_encode($monthlyData) !!},
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#4f46e5',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Tren Panen Bulanan {{ date('Y') }}'
                        },
                        legend: {
                            display: false
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

            // Daily Performance Chart
            const dailyPerfCtx = document.getElementById('dailyPerformanceChart').getContext('2d');
            new Chart(dailyPerfCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($dailyLabels) !!},
                    datasets: [{
                        label: 'Harvest Harian',
                        data: {!! json_encode($dailyData) !!},
                        backgroundColor: 'rgba(34, 197, 94, 0.8)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Performa Harian (7 Hari Terakhir)'
                        },
                        legend: {
                            display: false
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

            // Block Performance Chart
            @if ($blockData && $blockData->count() > 0)
                const blockPerfCtx = document.getElementById('blockPerformanceChart').getContext('2d');
                new Chart(blockPerfCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($blockLabels) !!},
                        datasets: [{
                            label: 'Total Harvest',
                            data: {!! json_encode($blockChartData) !!},
                            backgroundColor: [
                                '#8B5CF6', '#10B981', '#F59E0B', '#EF4444', '#3B82F6',
                                '#EC4899', '#84CC16', '#F97316', '#6366F1', '#14B8A6'
                            ],
                            borderRadius: 6
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Performa per Blok'
                            },
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
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
            @endif

            // Quality Score Chart
            @if ($qualityData && $qualityData->ripe + $qualityData->over_ripe + $qualityData->under_ripe + $qualityData->eb > 0)
                const qualityScoreCtx = document.getElementById('qualityScoreChart').getContext('2d');
                const totalBuah =
                    {{ $qualityData->ripe + $qualityData->over_ripe + $qualityData->under_ripe + $qualityData->eb }};
                const ripePercent =
                    {{ ($qualityData->ripe / ($qualityData->ripe + $qualityData->over_ripe + $qualityData->under_ripe + $qualityData->eb)) * 100 }};

                new Chart(qualityScoreCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Kualitas', 'Sisa'],
                        datasets: [{
                            data: [ripePercent, 100 - ripePercent],
                            backgroundColor: [
                                ripePercent >= 80 ? '#28a745' : ripePercent >= 60 ? '#ffc107' :
                                '#dc3545',
                                '#f8f9fa'
                            ],
                            borderWidth: 0
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
                        cutout: '80%'
                    }
                });
            @endif

            // Quality Distribution Chart
            @if ($qualityData && $qualityData->ripe + $qualityData->over_ripe + $qualityData->under_ripe + $qualityData->eb > 0)
                const qualityDistCtx = document.getElementById('qualityDistributionChart').getContext('2d');

                new Chart(qualityDistCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Ripe', 'Over Ripe', 'Under Ripe', 'Empty Bunch', 'Brondolan'],
                        datasets: [{
                            label: 'Jumlah Buah',
                            data: [
                                {{ $qualityChartData['ripe'] }},
                                {{ $qualityChartData['over_ripe'] }},
                                {{ $qualityChartData['under_ripe'] }},
                                {{ $qualityChartData['eb'] }},
                                {{ $qualityChartData['brondolan'] }}
                            ],
                            backgroundColor: [
                                '#28a745',
                                '#ffc107',
                                '#dc3545',
                                '#6c757d',
                                '#3b82f6'
                            ],
                            borderRadius: 8,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Distribusi Kualitas Panen Anda'
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
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
            @endif
        });

        // Refresh dashboard function
        function refreshDashboard() {
            location.reload();
        }

        // Add some loading animation
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade in animation to cards
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
@endpush
