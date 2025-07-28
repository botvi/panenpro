@extends('template-admin.layout')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-asisten">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Grafik Kepatuhan</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Data Grafik Kepatuhan</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tabel Data Grafik Kepatuhan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Grafik Kepatuhan Charts start -->
                <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        <h5>Distribusi Alas Karung Brondol</h5>
                      </div>
                      <div class="card-body">
                        <canvas id="chart-alas-karung" width="400" height="200"></canvas>
                      </div>
                    </div>
                  </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Distribusi Panen Pokok 17</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="chart-panen-blok" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Distribusi Keluar Buah</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="chart-keluar-buah" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Grafik Kepatuhan Charts end -->
                
                <!-- Grafik Kepatuhan table start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Tabel Data Grafik Kepatuhan</h5>
                            <span class="badge bg-info">Read Only Access</span>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemanen</th>
                                            <th>Mandor</th>
                                            <th>Keluar Buah</th>
                                            <th>Alas Karung Brondol</th>
                                            <th>Panen Pokok 17</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($grafikkepatuhan as $m => $item)
                                            <tr>
                                                <td>{{ $m + 1 }}</td>
                                                <td>{{ $item->pemanen->nama ?? 'N/A' }}</td>
                                                <td>{{ $item->mandor->nama ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($item->keluar_buah == 'Kurang dari 9')
                                                        &lt; 9
                                                    @elseif($item->keluar_buah == 'Lebih dari 9')
                                                        &gt; 9
                                                    @else
                                                        {{ $item->keluar_buah }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->alas_karung_brondol == 'Ya')
                                                        <span
                                                            style="background-color: #d1fae5; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                                                            <i class="ti ti-check text-success"></i>
                                                        </span>
                                                    @else
                                                        <span
                                                            style="background-color: #fee2e2; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                                                            <i class="ti ti-x text-danger"></i>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->panen_blok_17 == 'Ya')
                                                        <span
                                                            style="background-color: #d1fae5; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                                                            <i class="ti ti-check text-success"></i>
                                                        </span>
                                                    @else
                                                        <span
                                                            style="background-color: #fee2e2; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                                                            <i class="ti ti-x text-danger"></i>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemanen</th>
                                            <th>Mandor</th>
                                            <th>Keluar Buah</th>
                                            <th>Alas Karung Brondol</th>
                                            <th>Panen Pokok 17</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Chart 1: Distribusi Alas Karung Brondol - Bar Style (mengikuti chart 3, tidak stacked)
            const ctx1 = document.getElementById('chart-alas-karung').getContext('2d');
            const chartAlasKarung = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: [
                        @php
                            $labels = [];
                            for ($i = 6; $i >= 0; $i--) {
                                $date = \Carbon\Carbon::now()->subDays($i);
                                $labels[] = $date->format('d-M');
                            }
                            echo "'" . implode("', '", $labels) . "'";
                        @endphp
                    ],
                    datasets: [
                        {
                            label: 'Ya',
                            data: [
                                @foreach($persentasePerTanggalAlasKarungBrondol as $tanggal => $data)
                                    {{ $data['persentaseYa'] }},
                                @endforeach
                            ],
                            backgroundColor: '#3b82f6',
                            borderColor: '#2563eb',
                            borderWidth: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                        },
                        {
                            label: 'Tidak',
                            data: [
                                @foreach($persentasePerTanggalAlasKarungBrondol as $tanggal => $data)
                                    {{ $data['persentaseTidak'] }},
                                @endforeach
                            ],
                            backgroundColor: '#f59e0b',
                            borderColor: '#d97706',
                            borderWidth: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: false, // diubah menjadi false agar tidak stacked seperti chart 3
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            stacked: false, // diubah menjadi false agar tidak stacked seperti chart 3
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                },
                                stepSize: 10
                            },
                            grid: {
                                color: '#f1f5f9'
                            }
                        }
                    }
                }
            });

            // Chart 2: Distribusi Panen Pokok 17 - Bar Style (mengikuti chart 3, tidak stacked)
            const ctx2 = document.getElementById('chart-panen-blok').getContext('2d');
            const chartPanenBlok = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: [
                        @php
                            $labels = [];
                            for ($i = 6; $i >= 0; $i--) {
                                $date = \Carbon\Carbon::now()->subDays($i);
                                $labels[] = $date->format('d-M');
                            }
                            echo "'" . implode("', '", $labels) . "'";
                        @endphp
                    ],
                    datasets: [
                        {
                            label: 'Ya',
                            data: [
                                @foreach($persentasePerTanggalPanenBlok17 as $tanggal => $data)
                                    {{ $data['persentaseYa'] }},
                                @endforeach
                            ],
                            backgroundColor: '#3b82f6',
                            borderColor: '#2563eb',
                            borderWidth: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                        },
                        {
                            label: 'Tidak',
                            data: [
                                @foreach($persentasePerTanggalPanenBlok17 as $tanggal => $data)
                                    {{ $data['persentaseTidak'] }},
                                @endforeach
                            ],
                            backgroundColor: '#f59e0b',
                            borderColor: '#d97706',
                            borderWidth: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: false, // diubah menjadi false agar tidak stacked seperti chart 3
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            stacked: false, // diubah menjadi false agar tidak stacked seperti chart 3
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                },
                                stepSize: 10
                            },
                            grid: {
                                color: '#f1f5f9'
                            }
                        }
                    }
                }
            });

            // Chart 3: Distribusi Keluar Buah - Bar Style (tidak stacked)
            const ctx3 = document.getElementById('chart-keluar-buah').getContext('2d');
            const chartKeluarBuah = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: [
                        @php
                            $labels = [];
                            for ($i = 6; $i >= 0; $i--) {
                                $date = \Carbon\Carbon::now()->subDays($i);
                                $labels[] = $date->format('d-M');
                            }
                            echo "'" . implode("', '", $labels) . "'";
                        @endphp
                    ],
                    datasets: [
                        {
                            label: '< 9',
                            data: [
                                @foreach($persentasePerTanggalDistribusibuahkeluar as $tanggal => $data)
                                    {{ $data['persentaseKurangDari9'] }},
                                @endforeach
                            ],
                            backgroundColor: '#22c55e',
                            borderColor: '#16a34a',
                            borderWidth: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                        },
                        {
                            label: '> 9',
                            data: [
                                @foreach($persentasePerTanggalDistribusibuahkeluar as $tanggal => $data)
                                    {{ $data['persentaseLebihDari9'] }},
                                @endforeach
                            ],
                            backgroundColor: '#ef4444',
                            borderColor: '#b91c1c',
                            borderWidth: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: false,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            stacked: false,
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                },
                                stepSize: 10
                            },
                            grid: {
                                color: '#f1f5f9'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
