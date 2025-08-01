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
        <!-- Grafik Kepatuhan table start -->
        <div class="col-md-12">
          <!-- Filter Form -->
          <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('grafikkepatuhan.index') }}" method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label for="filter_tanggal" class="form-label">Filter Tanggal</label>
                            <input type="date" name="filter_tanggal" id="filter_tanggal" class="form-control" value="{{ $filterTanggal }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-filter me-1"></i>Filter
                            </button>
                            <a href="{{ route('grafikkepatuhan.index') }}" class="btn btn-secondary">
                                <i class="ti ti-refresh me-1"></i>Reset
                            </a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>

          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tabel Data Grafik Kepatuhan</h5>
                <a href="{{ route('grafikkepatuhan.create') }}" class="btn btn-sm btn-primary">Tambah Data Grafik Kepatuhan</a>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pemanen</th>
                      <th>Keluar Buah</th>
                      <th>Alas Karung Brondol</th>
                      <th>Panen Blok 17</th>
                      <th>Stampel Panen</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($grafikkepatuhan as $m => $item)
                    <tr>
                      <td>{{ $m+1 }}</td>
                      <td>{{ $item->pemanen->nama }}</td>
                      <td>
                        @if($item->keluar_buah == 'Kurang dari 9')
                          &lt; 9
                        @elseif($item->keluar_buah == 'Lebih dari 9')
                          &gt; 9
                        @else
                          {{ $item->keluar_buah }}
                        @endif
                      </td>
                      <td>
                        @if($item->alas_karung_brondol == 'Ya')
                          <span style="background-color: #d1fae5; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                            <i class="ti ti-check text-success"></i>
                          </span>
                        @else
                          <span style="background-color: #fee2e2; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                            <i class="ti ti-x text-danger"></i>
                          </span>
                        @endif
                      </td>
                      <td>
                        @if($item->panen_blok_17 == 'Ya')
                          <span style="background-color: #d1fae5; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                            <i class="ti ti-check text-success"></i>
                          </span>
                        @else
                          <span style="background-color: #fee2e2; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                            <i class="ti ti-x text-danger"></i>
                          </span>
                        @endif
                      </td>
                      <td>
                        @if($item->stampel_panen == 'Ya')
                          <span style="background-color: #d1fae5; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                            <i class="ti ti-check text-success"></i>
                          </span>
                        @else
                          <span style="background-color: #fee2e2; border-radius: 50%; padding: 6px 9px; display: inline-block;">
                              <i class="ti ti-x text-danger"></i>
                          </span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('grafikkepatuhan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('grafikkepatuhan.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                      <th>Keluar Buah</th>
                      <th>Alas Karung Brondol</th>
                      <th>Panen Blok 17</th>
                      <th>Stampel Panen</th>
                      <th>Aksi</th>
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
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
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