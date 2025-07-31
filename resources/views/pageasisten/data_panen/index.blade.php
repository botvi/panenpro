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
                                <li class="breadcrumb-item"><a href="/dashboard-pemanen">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Panen</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Data Panen</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tabel Data Panen</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Grafik Kepatuhan table start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Tabel Data Panen</h5>
                            <span class="badge bg-info">Read Only Access</span>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemanen</th>
                                            <th>Nama Blok</th>
                                            <th>No TPH</th>
                                            <th>Ripe</th>
                                            <th>Over Ripe</th>
                                            <th>Under Ripe</th>
                                            <th>EB</th>
                                            <th>Jumlah Buah/Blok</th>
                                            <th>Brondolan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalBrondolan = $datapanen->sum('brondolan');
                                        @endphp
                                        @foreach ($datapanen as $m => $item)
                                            <tr>
                                                <td>{{ $m + 1 }}</td>
                                                <td>{{ $item->pemanen->nama }}</td>
                                                <td>{{ $item->blok->blok }}</td>
                                                <td>{{ $item->no_tph }}</td>
                                                <td>{{ $item->ripe }}</td>
                                                <td>{{ $item->over_ripe }}</td>
                                                <td>{{ $item->under_ripe }}</td>
                                                <td>{{ $item->eb }}</td>
                                                <td>{{ $item->jumlah_buah_per_blok }}</td>
                                                <td>{{ $item->brondolan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemanen</th>
                                            <th>Nama Blok</th>
                                            <th>No TPH</th>
                                            <th>Ripe</th>
                                            <th>Over Ripe</th>
                                            <th>Under Ripe</th>
                                            <th>EB</th>
                                            <th>Jumlah Buah/Blok</th>
                                            <th>Brondolan</th>
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
    <script>
        $(document).ready(function() {
            $('#simpletable').DataTable();
        });
    </script>
@endsection
