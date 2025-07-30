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
                <!-- Filter Section -->
                <div class="col-md-12 mb-4">
                    <div class="card filter-card">
                        <div class="card-header">
                            <h5 class="mb-0">Filter Grafik Kepatuhan</h5>
                        </div>
                        <div class="card-body">
                            <form id="filterForm" class="row g-3">
                                <div class="col-md-3">
                                    <label for="dateFrom" class="form-label">Dari Tanggal</label>
                                    <input type="date" class="form-control" id="dateFrom" name="dateFrom"
                                        value="{{ now()->subDays(6)->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="dateTo" class="form-label">Sampai Tanggal</label>
                                    <input type="date" class="form-control" id="dateTo" name="dateTo"
                                        value="{{ now()->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="mandorFilter" class="form-label">Mandor</label>
                                    <select class="form-select" id="mandorFilter" name="mandorFilter">
                                        <option value="">Semua Mandor</option>
                                        @if (isset($mandors))
                                            @foreach ($mandors as $mandor)
                                                <option value="{{ $mandor->user_id }}">{{ $mandor->nama }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="pemanenFilter" class="form-label">Pemanen</label>
                                    <select class="form-select" id="pemanenFilter" name="pemanenFilter">
                                        <option value="">Semua Pemanen</option>
                                        @if (isset($pemanens))
                                            @foreach ($pemanens as $pemanen)
                                                <option value="{{ $pemanen->user_id }}">{{ $pemanen->nama }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" onclick="applyFilter()">
                                        <i class="ti ti-filter me-2"></i>Terapkan Filter
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="resetFilter()">
                                        <i class="ti ti-refresh me-2"></i>Reset Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Statistics Summary -->
                <div class="col-md-12 mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card stats-card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ti ti-chart-bar f-36"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="text-white mb-1">Total Data</h6>
                                            <h4 class="text-white mb-0" id="totalDataCount">
                                                {{ count($grafikkepatuhan ?? []) }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card stats-card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ti ti-check f-36"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="text-white mb-1">Keluar Buah &lt; 9</h6>
                                            <h4 class="text-white mb-0" id="kurangDari9Count">
                                                {{ collect($grafikkepatuhan ?? [])->where('keluar_buah', 'Kurang dari 9')->count() }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card stats-card bg-danger text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ti ti-x f-36"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="text-white mb-1">Keluar Buah &gt; 9</h6>
                                            <h4 class="text-white mb-0" id="lebihDari9Count">
                                                {{ collect($grafikkepatuhan ?? [])->where('keluar_buah', 'Lebih dari 9')->count() }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Statistics -->
                        <div class="col-md-12 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card stats-card bg-warning text-dark">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <i class="ti ti-plant f-36"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-2 fw-bold">Alas Karung Brondol</h6>
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <span class="badge bg-success me-2">Ya</span>
                                                                <span class="fw-bold" id="yaAlasKarungCount">
                                                                    {{ collect($grafikkepatuhan ?? [])->where('alas_karung_brondol', 'Ya')->count() }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <span class="badge bg-danger me-2">Tidak</span>
                                                                <span class="fw-bold" id="tidakAlasKarungCount">
                                                                    {{ collect($grafikkepatuhan ?? [])->where('alas_karung_brondol', 'Tidak')->count() }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card stats-card bg-light text-dark">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <i class="ti ti-plant f-36 text-success"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-2 fw-bold">Panen Pokok 17</h6>
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <span class="badge bg-success me-2">Ya</span>
                                                                <span class="fw-bold" id="yaPanenCount">
                                                                    {{ collect($grafikkepatuhan ?? [])->where('panen_pokok_17', 'Ya')->count() }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <span class="badge bg-danger me-2">Tidak</span>
                                                                <span class="fw-bold" id="tidakPanenCount">
                                                                    {{ collect($grafikkepatuhan ?? [])->where('panen_pokok_17', 'Tidak')->count() }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                            <tbody id="dataTableBody">
                                                <!-- Data akan diisi oleh JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
        // Global variables untuk chart instances
        let chartAlasKarung, chartPanenBlok, chartKeluarBuah;
        let originalData = @json($grafikkepatuhan ?? []);
        let filteredData = originalData;

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners for auto date adjustment
            document.getElementById('dateFrom').addEventListener('change', function() {
                const fromDate = new Date(this.value);
                if (fromDate) {
                    const toDate = new Date(fromDate);
                    toDate.setDate(fromDate.getDate() + 6);
                    document.getElementById('dateTo').value = toDate.toISOString().split('T')[0];
                }
            });

            document.getElementById('dateTo').addEventListener('change', function() {
                const toDate = new Date(this.value);
                if (toDate) {
                    const fromDate = new Date(toDate);
                    fromDate.setDate(toDate.getDate() - 6);
                    document.getElementById('dateFrom').value = fromDate.toISOString().split('T')[0];
                }
            });

            initializeCharts();
            updateCounters();
            updateTable();
        });

        function initializeCharts() {
            // Destroy existing charts if they exist
            if (chartAlasKarung) chartAlasKarung.destroy();
            if (chartPanenBlok) chartPanenBlok.destroy();
            if (chartKeluarBuah) chartKeluarBuah.destroy();

            // Calculate data for filtered results
            const chartData = calculateChartData(filteredData);

            // Chart 1: Distribusi Alas Karung Brondol - Bar Style
            const ctx1 = document.getElementById('chart-alas-karung').getContext('2d');
            chartAlasKarung = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                            label: 'Ya',
                            data: chartData.alasKarungYa,
                            backgroundColor: '#3b82f6',
                            borderColor: '#2563eb',
                            borderWidth: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                        },
                        {
                            label: 'Tidak',
                            data: chartData.alasKarungTidak,
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

            // Chart 2: Distribusi Panen Pokok 17 - Bar Style
            const ctx2 = document.getElementById('chart-panen-blok').getContext('2d');
            chartPanenBlok = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                            label: 'Ya',
                            data: chartData.panenYa,
                            backgroundColor: '#3b82f6',
                            borderColor: '#2563eb',
                            borderWidth: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                        },
                        {
                            label: 'Tidak',
                            data: chartData.panenTidak,
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

            // Chart 3: Distribusi Keluar Buah - Bar Style
            const ctx3 = document.getElementById('chart-keluar-buah').getContext('2d');
            chartKeluarBuah = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                            label: '< 9',
                            data: chartData.buahKurang9,
                            backgroundColor: '#22c55e',
                            borderColor: '#16a34a',
                            borderWidth: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                        },
                        {
                            label: '> 9',
                            data: chartData.buahLebih9,
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
        }

        // Function to calculate chart data based on filtered data
        function calculateChartData(data) {
            const labels = [];
            const alasKarungYa = [];
            const alasKarungTidak = [];
            const panenYa = [];
            const panenTidak = [];
            const buahKurang9 = [];
            const buahLebih9 = [];

            // Get date range from filter inputs
            const dateFromInput = document.getElementById('dateFrom').value;
            const dateToInput = document.getElementById('dateTo').value;
            
            let startDate, endDate;
            
            if (dateFromInput && dateToInput) {
                startDate = new Date(dateFromInput);
                endDate = new Date(dateToInput);
            } else {
                // Default to last 7 days if no dates specified
                endDate = new Date();
                startDate = new Date();
                startDate.setDate(endDate.getDate() - 6);
            }

            // Calculate the number of days in the range
            const daysDiff = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
            const maxDays = Math.min(daysDiff, 7); // Limit to maximum 7 days for chart readability

            // Generate labels based on the selected date range
            for (let i = maxDays - 1; i >= 0; i--) {
                const date = new Date(endDate);
                date.setDate(endDate.getDate() - i);
                labels.push(date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short'
                }));

                const dayData = data.filter(item => {
                    const itemDate = new Date(item.tanggal);
                    return itemDate.toDateString() === date.toDateString();
                });

                const totalPerHari = dayData.length;

                // Alas Karung Brondol
                const yaAlas = dayData.filter(item => item.alas_karung_brondol === 'Ya').length;
                const tidakAlas = dayData.filter(item => item.alas_karung_brondol !== 'Ya').length;
                alasKarungYa.push(totalPerHari > 0 ? Math.round((yaAlas / totalPerHari) * 100) : 0);
                alasKarungTidak.push(totalPerHari > 0 ? Math.round((tidakAlas / totalPerHari) * 100) : 0);

                // Panen Pokok 17
                const yaPanen = dayData.filter(item => item.panen_blok_17 === 'Ya').length;
                const tidakPanen = dayData.filter(item => item.panen_blok_17 !== 'Ya').length;
                panenYa.push(totalPerHari > 0 ? Math.round((yaPanen / totalPerHari) * 100) : 0);
                panenTidak.push(totalPerHari > 0 ? Math.round((tidakPanen / totalPerHari) * 100) : 0);

                // Keluar Buah
                const kurang9 = dayData.filter(item => item.keluar_buah === 'Kurang dari 9').length;
                const lebih9 = dayData.filter(item => item.keluar_buah === 'Lebih dari 9').length;
                buahKurang9.push(totalPerHari > 0 ? Math.round((kurang9 / totalPerHari) * 100) : 0);
                buahLebih9.push(totalPerHari > 0 ? Math.round((lebih9 / totalPerHari) * 100) : 0);
            }

            return {
                labels,
                alasKarungYa,
                alasKarungTidak,
                panenYa,
                panenTidak,
                buahKurang9,
                buahLebih9
            };
        }

        // Function to apply filter
        function applyFilter() {
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;
            const mandorFilter = document.getElementById('mandorFilter').value;
            const pemanenFilter = document.getElementById('pemanenFilter').value;

            console.log('Filter applied:', { dateFrom, dateTo, mandorFilter, pemanenFilter });
            console.log('Original data count:', originalData.length);

            // Filter data berdasarkan parameter
            filteredData = originalData.slice(); // Copy original data

            if (dateFrom && dateTo) {
                filteredData = filteredData.filter(item => {
                    const itemDate = new Date(item.tanggal);
                    const fromDate = new Date(dateFrom);
                    const toDate = new Date(dateTo);
                    
                    // Set time to compare only dates
                    fromDate.setHours(0, 0, 0, 0);
                    toDate.setHours(23, 59, 59, 999);
                    itemDate.setHours(12, 0, 0, 0); // Set to noon to avoid timezone issues
                    
                    return itemDate >= fromDate && itemDate <= toDate;
                });
                console.log('After date filter:', filteredData.length);
            }

            if (mandorFilter) {
                filteredData = filteredData.filter(item => {
                    // Compare with mandor_id (which is user_id in database)
                    return item.mandor_id == mandorFilter;
                });
                console.log('After mandor filter:', filteredData.length);
            }

            if (pemanenFilter) {
                filteredData = filteredData.filter(item => {
                    // Compare with pemanen_id (which is user_id in database)
                    return item.pemanen_id == pemanenFilter;
                });
                console.log('After pemanen filter:', filteredData.length);
            }

            console.log('Final filtered data count:', filteredData.length);

            // Re-initialize charts with filtered data
            initializeCharts();
            updateCounters();
            updateStatistics();
            updateTable();

            // Show success message
            showAlert('Filter berhasil diterapkan! Menampilkan ' + filteredData.length + ' data.', 'success');
        }

        // Function to reset filter
        function resetFilter() {
            document.getElementById('dateFrom').value = '{{ now()->subDays(6)->format('Y-m-d') }}';
            document.getElementById('dateTo').value = '{{ now()->format('Y-m-d') }}';
            document.getElementById('mandorFilter').value = '';
            document.getElementById('pemanenFilter').value = '';

            filteredData = originalData.slice();
            initializeCharts();
            updateCounters();
            updateStatistics();
            updateTable();

            showAlert('Filter berhasil direset!', 'info');
        }

        // Function to update all counters
        function updateCounters() {
            // This function will be implemented if needed for individual counters
        }

        // Function to update main statistics
        function updateStatistics() {
            const total = filteredData.length;
            const kurangDari9 = filteredData.filter(item => item.keluar_buah === 'Kurang dari 9').length;
            const lebihDari9 = filteredData.filter(item => item.keluar_buah === 'Lebih dari 9').length;

            // Update statistics cards
            document.getElementById('totalDataCount').textContent = total;
            document.getElementById('kurangDari9Count').textContent = kurangDari9;
            document.getElementById('lebihDari9Count').textContent = lebihDari9;

            // Update additional statistics
            const yaAlasKarung = filteredData.filter(item => item.alas_karung_brondol === 'Ya').length;
            const tidakAlasKarung = filteredData.filter(item => item.alas_karung_brondol !== 'Ya').length;
            const yaPanen = filteredData.filter(item => item.panen_blok_17 === 'Ya').length;
            const tidakPanen = filteredData.filter(item => item.panen_blok_17 !== 'Ya').length;

            // Update the correct element IDs based on the HTML structure
            if (document.getElementById('yaAlasKarungCount')) {
                document.getElementById('yaAlasKarungCount').textContent = yaAlasKarung;
            }
            if (document.getElementById('tidakAlasKarungCount')) {
                document.getElementById('tidakAlasKarungCount').textContent = tidakAlasKarung;
            }
            if (document.getElementById('yaPanenCount')) {
                document.getElementById('yaPanenCount').textContent = yaPanen;
            }
            if (document.getElementById('tidakPanenCount')) {
                document.getElementById('tidakPanenCount').textContent = tidakPanen;
            }
        }

        // Function to update table
        function updateTable() {
            const tableBody = document.getElementById('dataTableBody');

            if (!tableBody) return;

            // Clear existing rows
            tableBody.innerHTML = '';

            // Add filtered data to table
            filteredData.forEach((item, index) => {
                const row = document.createElement('tr');

                // Format tanggal
                const tanggal = new Date(item.tanggal).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                });

                // Keluar Buah badge
                let keluarBuahBadge;
                if (item.keluar_buah === 'Kurang dari 9') {
                    keluarBuahBadge = '<span class="badge bg-success">&lt; 9</span>';
                } else if (item.keluar_buah === 'Lebih dari 9') {
                    keluarBuahBadge = '<span class="badge bg-danger">&gt; 9</span>';
                } else {
                    keluarBuahBadge = `<span class="badge bg-secondary">${item.keluar_buah}</span>`;
                }

                // Alas Karung icon
                const alasKarungIcon = item.alas_karung_brondol === 'Ya' ?
                    '<span style="background-color: #d1fae5; border-radius: 50%; padding: 6px 9px; display: inline-block;"><i class="ti ti-check text-success"></i></span>' :
                    '<span style="background-color: #fee2e2; border-radius: 50%; padding: 6px 9px; display: inline-block;"><i class="ti ti-x text-danger"></i></span>';

                // Panen Blok 17 icon
                const panenBlokIcon = item.panen_blok_17 === 'Ya' ?
                    '<span style="background-color: #d1fae5; border-radius: 50%; padding: 6px 9px; display: inline-block;"><i class="ti ti-check text-success"></i></span>' :
                    '<span style="background-color: #fee2e2; border-radius: 50%; padding: 6px 9px; display: inline-block;"><i class="ti ti-x text-danger"></i></span>';

                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.pemanen ? item.pemanen.nama : 'N/A'}</td>
                    <td>${item.mandor ? item.mandor.nama : 'N/A'}</td>
                    <td>${keluarBuahBadge}</td>
                    <td>${alasKarungIcon}</td>
                    <td>${panenBlokIcon}</td>
                    <td>${tanggal}</td>
                `;

                tableBody.appendChild(row);
            });
        }

        // Alert function
        function showAlert(message, type = 'info') {
            // Create alert element
            const alertDiv = document.createElement('div');
            alertDiv.className =
                `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
            alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 10000; min-width: 300px;';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(alertDiv);

            // Auto remove after 3 seconds
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 3000);
        }
    </script>
@endsection
