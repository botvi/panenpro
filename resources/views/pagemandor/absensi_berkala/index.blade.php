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
                                <li class="breadcrumb-item"><a href="/dashboard-mandor">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Absensi Berkala</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Data Absensi Berkala</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tabel Data Absensi Berkala</h2>
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
                            <h5 class="mb-0">Tabel Data Absensi Berkala</h5>
                            <a href="{{ route('absensiberkala.create') }}" class="btn btn-sm btn-primary">Tambah Data
                                Absensi Berkala</a>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemanen</th>
                                            <th>Blok</th>
                                            <th>Baris</th>
                                            <th>Arah Masuk</th>
                                            <th>Jam</th>
                                            <th>Luasan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalLuasan = $absensiberkala->sum('luasan');
                                        @endphp
                                        @foreach ($absensiberkala as $m => $item)
                                            <tr>
                                                <td>{{ $m + 1 }}</td>
                                                <td>{{ $item->pemanen->nama }}</td>
                                                <td>
                                                    {{ $item->blok->blok }}
                                                </td>
                                                <td>
                                                    {{ $item->baris }}
                                                </td>
                                                <td>
                                                    {{ $item->arah_masuk }}
                                                </td>
                                                <td>
                                                    {{ $item->jam }}
                                                </td>
                                                <td>
                                                    {{ $item->luasan }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('absensiberkala.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('absensiberkala.destroy', $item->id) }}"
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
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemanen</th>
                                            <th>Blok</th>
                                            <th>Baris</th>
                                            <th>Arah Masuk</th>
                                            <th>Jam</th>
                                            <th>Luasan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <tr>
                                            <th colspan="6" style="text-align: right; font-weight: bold;">Total:</th>
                                            <th style="font-weight: bold;">{{ $totalLuasan }}</th>
                                            <th></th>
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
