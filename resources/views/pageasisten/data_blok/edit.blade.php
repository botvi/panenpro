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
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Blok</a></li>
                                <li class="breadcrumb-item" aria-current="page">Form Edit Data Blok</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Edit Data Blok</h2>
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
                            <h5>Form Edit Data Blok</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('datablok.update', $blok->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="form-label">Blok</label>
                                    <input type="text" name="blok" id="blok" class="form-control" required
                                        value="{{ old('blok', $blok->blok) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Estate</label>
                                    <input type="text" name="estate" id="estate" class="form-control" required
                                        value="{{ old('estate', $blok->estate) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Afdeling</label>
                                    <input type="text" name="adfeling" id="adfeling" class="form-control" required
                                        value="{{ old('adfeling', $blok->adfeling) }}">
                                </div>
                                <div class="form-row row g-3 mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">TT</label>
                                        <input type="number" name="tt" id="tt" class="form-control" required
                                            value="{{ old('tt', $blok->tt) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Luas</label>
                                        <input type="number" name="luas" id="luas" class="form-control" required
                                            value="{{ old('luas', $blok->luas) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">BJR</label>
                                        <input type="number" name="bjr" id="bjr" class="form-control" required
                                            value="{{ old('bjr', $blok->bjr) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">SPH</label>
                                        <input type="number" name="sph" id="sph" class="form-control" required
                                            value="{{ old('sph', $blok->sph) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jumlah Pokok</label>
                                    <input type="number" name="jumlah_pokok" id="jumlah_pokok" class="form-control"
                                        required readonly value="{{ old('jumlah_pokok', $blok->jumlah_pokok) }}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
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
        function hitungJumlahPokok() {
            const tt = parseInt(document.getElementById('tt').value) || 0;
            const luas = parseInt(document.getElementById('over_ripe').value) || 0;
            const bjr = parseInt(document.getElementById('under_ripe').value) || 0;
            const sph = parseInt(document.getElementById('eb').value) || 0;
            const total = tt + luas + bjr + sph;
            document.getElementById('jumlah_pokok').value = total;
        }

        document.getElementById('tt').addEventListener('input', hitungJumlahPokok);
        document.getElementById('luas').addEventListener('input', hitungJumlahPokok);
        document.getElementById('bjr').addEventListener('input', hitungJumlahPokok);
        document.getElementById('sph').addEventListener('input', hitungJumlahPokok);
    </script>
@endsection
