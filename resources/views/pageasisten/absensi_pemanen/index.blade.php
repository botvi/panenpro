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
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Absensi Pemanen</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Data Absensi Pemanen</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tabel Data Absensi Pemanen</h2>
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
                            <h5 class="mb-0">Tabel Data Absensi Pemanen</h5>
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
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensipemanen as $m => $item)
                                            <tr>
                                                <td>{{ $m + 1 }}</td>
                                                <td>{{ $item->pemanen->nama }}</td>
                                                <td>{{ $item->mandor->nama ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge 
                                                        @if($item->keterangan == 'P(Panen)') bg-success 
                                                        @elseif($item->keterangan == 'M(Mangkir)') bg-danger
                                                        @elseif($item->keterangan == 'S(Sakit)') bg-warning
                                                        @elseif($item->keterangan == 'C(Cuti)') bg-info
                                                        @elseif($item->keterangan == 'R(Rawat)') bg-secondary
                                                        @else bg-light @endif">
                                                        {{ $item->keterangan }}
                                                    </span>
                                                </td>
                                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemanen</th>
                                            <th>Mandor</th>
                                            <th>Keterangan</th>
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
