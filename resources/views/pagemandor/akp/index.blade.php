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
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Data AKP</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Data AKP</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tabel Data AKP</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Plan AKP table start -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Tabel Data Plan AKP</h5>
                            <a href="{{ route('planakp.create') }}" class="btn btn-sm btn-primary">Tambah Data Plan AKP</a>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="table-planakp" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Blok</th>
                                            <th>Satuan Per Hektar</th>
                                            <th>Jumlah Janjang</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalSum = 0;
                                            $totalCount = 0;
                                        @endphp
                                        @foreach ($planakp as $m => $item)
                                            <tr>
                                                <td>{{ $m + 1 }}</td>
                                                <td>{{ $item->blok->blok }}</td>
                                                <td>{{ $item->satuan_per_hektar }}</td>
                                                <td>{{ $item->jumlah_janjang }}</td>
                                                <td>{{ $item->total }}%</td>
                                                <td>
                                                    <a href="{{ route('planakp.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('planakp.destroy', $item->id) }}" method="POST"
                                                        style="display:inline;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @php
                                                $totalSum += $item->total;
                                                $totalCount++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Blok</th>
                                            <th>Satuan Per Hektar</th>
                                            <th>Jumlah Janjang</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4" style="text-align:right">Rata-rata Total</th>
                                            <th colspan="2">
                                                @if ($totalCount > 0)
                                                    {{ number_format($totalSum / $totalCount, 2) }}%
                                                @else
                                                    0%
                                                @endif
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Plan AKP table end -->
                <!-- Aktual AKP table start -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Tabel Data Aktual AKP</h5>
                            <a href="{{ route('aktualakp.create') }}" class="btn btn-sm btn-primary">Tambah Data Aktual
                                AKP</a>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="table-aktualakp" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Blok</th>
                                            <th>Satuan Per Hektar</th>
                                            <th>Jumlah Janjang</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $totalSum2 = 0;
                                        $totalCount2 = 0;
                                    @endphp
                                    <tbody>
                                        @foreach ($aktualakp as $n => $item)
                                            <tr>
                                                <td>{{ $n + 1 }}</td>
                                                <td>{{ $item->blok->blok }}</td>
                                                <td>{{ $item->satuan_per_hektar }}</td>
                                                <td>{{ $item->jumlah_janjang }}</td>
                                                <td>{{ $item->total }}%</td>
                                                <td>
                                                    <a href="{{ route('aktualakp.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('aktualakp.destroy', $item->id) }}"
                                                        method="POST" style="display:inline;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @php
                                                $totalSum2 += $item->total;
                                                $totalCount2++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Blok</th>
                                            <th>Satuan Per Hektar</th>
                                            <th>Jumlah Janjang</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4" style="text-align:right">Rata-rata Total</th>
                                            <th colspan="2">
                                                @if ($totalCount2 > 0)
                                                    {{ number_format($totalSum2 / $totalCount2, 2) }}%
                                                @else
                                                    0%
                                                @endif
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Aktual AKP table end -->
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
            $('#table-planakp').DataTable();
            $('#table-aktualakp').DataTable();
        });
    </script>
@endsection
