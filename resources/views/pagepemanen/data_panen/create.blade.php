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
                                <li class="breadcrumb-item" aria-current="page">Form Tambah Data Panen</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Tambah Data Panen</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row justify-content-center">
                <!-- [ form-element ] start -->
                <div class="col-sm-12">
                    <!-- Basic Inputs -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Tambah Data Panen</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('datapanen.store') }}" method="POST">
                                @csrf
                                
                               
                                
                                <div class="form-group">
                                    <label class="form-label">Nama Blok</label>
                                    <input type="text" name="nama_blok" id="nama_blok" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No TPH</label>
                                    <input type="text" name="no_tph" id="no_tph" class="form-control" required>       
                                </div>
                                <div class="form-row d-flex flex-wrap justify-content-between">
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">Ripe</label>
                                        <input type="number" name="ripe" id="ripe" class="form-control" required>
                                    </div>
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">Over Ripe</label>
                                        <input type="number" name="over_ripe" id="over_ripe" class="form-control" required>
                                    </div>
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">Under Ripe</label>
                                        <input type="number" name="under_ripe" id="under_ripe" class="form-control" required>
                                    </div>
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">EB</label>
                                        <input type="number" name="eb" id="eb" class="form-control" required>
                                    </div>
                                    <div class="form-group flex-fill mb-3">
                                        <label class="form-label">Brondolan</label>
                                        <input type="number" name="brondolan" id="brondolan" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jumlah Buah Per Blok</label>
                                    <input type="number" name="jumlah_buah_per_blok" id="jumlah_buah_per_blok" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <button type="reset" class="btn btn-light">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
@endsection

@section('script')
<script>
    function hitungJumlahBuah() {
        const ripe = parseInt(document.getElementById('ripe').value) || 0;
        const overRipe = parseInt(document.getElementById('over_ripe').value) || 0;
        const underRipe = parseInt(document.getElementById('under_ripe').value) || 0;
        const eb = parseInt(document.getElementById('eb').value) || 0;
        const brondolan = parseInt(document.getElementById('brondolan').value) || 0;
        const total = ripe + overRipe + underRipe + eb + brondolan;
        document.getElementById('jumlah_buah_per_blok').value = total;
    }

    document.getElementById('ripe').addEventListener('input', hitungJumlahBuah);
    document.getElementById('over_ripe').addEventListener('input', hitungJumlahBuah);
    document.getElementById('under_ripe').addEventListener('input', hitungJumlahBuah);
    document.getElementById('eb').addEventListener('input', hitungJumlahBuah);
    document.getElementById('brondolan').addEventListener('input', hitungJumlahBuah);
</script>
@endsection