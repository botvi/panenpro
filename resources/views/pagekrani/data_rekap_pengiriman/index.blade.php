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
                                <li class="breadcrumb-item"><a href="/dashboard-krani">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Rekap Pengiriman</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Data Rekap Pengiriman</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tabel Data Rekap Pengiriman</h2>
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
                            <h5 class="mb-0">Tabel Data Rekap Pengiriman</h5>
                            <a href="{{ route('data-rekap-pengiriman.create') }}" class="btn btn-sm btn-primary">Tambah Data
                                Rekap Pengiriman</a>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Blok</th>
                                            <th>No TPH</th>
                                            <th>Kode Panen</th>
                                            <th>Ripe</th>
                                            <th>Over</th>
                                            <th>UR</th>
                                            <th>UDR</th>
                                            <th>Total</th>
                                            <th>BRD</th>
                                            <th>BS</th>
                                            <th>SPH</th>
                                            <th>BJr</th>
                                            <th>AKP Actual</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalBrondolan = $dataRekapPengiriman->sum('brondolan');
                                        @endphp
                                        @foreach ($dataRekapPengiriman as $m => $item)
                                            <tr>
                                                <td>{{ $m + 1 }}</td>
                                                <td>{{ $item->blok->blok }}</td>
                                                <td>{{ $item->no_tph }}</td>
                                                <td>{{ $item->kode_panen }}</td>
                                                <td>{{ $item->ripe }}</td>
                                                <td>{{ $item->over }}</td>
                                                <td>{{ $item->ur }}</td>
                                                <td>{{ $item->udr }}</td>
                                                <td>{{ $item->total }}</td>
                                                <td>{{ $item->brd }}</td>
                                                <td>{{ $item->bs }}</td>
                                                <td>{{ $item->blok->sph }}</td>
                                                <td>{{ $item->bjr }}</td>   
                                                <td>{{ $item->akp_actual }}%</td>
                                                <td>
                                                    <a href="{{ route('data-rekap-pengiriman.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('data-rekap-pengiriman.destroy', $item->id) }}"
                                                        method="POST" style="display:inline;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background-color: #f8f9fa; font-weight: bold;">
                                            <td colspan="4"><strong>GRAND TOTAL</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('ripe') }}</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('over') }}</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('ur') }}</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('udr') }}</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('total') }}</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('brd') }}</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('bs') }}</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum(function($item) { return $item->blok->sph; }) }}</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('bjr') }}</strong></td>
                                            <td><strong>{{ number_format($dataRekapPengiriman->avg('akp_actual'), 2) }}%</strong></td>
                                            <td></td>
                                        </tr>
                                        <tr style="background-color: #e3f2fd; font-weight: bold;">
                                            <td colspan="4"><strong>GRADING TOTAL (%)</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('total') > 0 ? number_format(($dataRekapPengiriman->sum('ripe') / $dataRekapPengiriman->sum('total')) * 100, 2) : '0.00' }}%</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('total') > 0 ? number_format(($dataRekapPengiriman->sum('over') / $dataRekapPengiriman->sum('total')) * 100, 2) : '0.00' }}%</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('total') > 0 ? number_format(($dataRekapPengiriman->sum('ur') / $dataRekapPengiriman->sum('total')) * 100, 2) : '0.00' }}%</strong></td>
                                            <td><strong>{{ $dataRekapPengiriman->sum('total') > 0 ? number_format(($dataRekapPengiriman->sum('udr') / $dataRekapPengiriman->sum('total')) * 100, 2) : '0.00' }}%</strong></td>
                                            <td></td>
                                            <td><strong>{{ ($dataRekapPengiriman->sum('total') * $dataRekapPengiriman->sum('bjr')) > 0 ? number_format(($dataRekapPengiriman->sum('brd') / ($dataRekapPengiriman->sum('total') * $dataRekapPengiriman->sum('bjr'))) * 100, 2) : '0.00' }}%</strong></td>
                                            <td colspan="5"></td>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#simpletable').DataTable();
        });
    </script>
@endsection
