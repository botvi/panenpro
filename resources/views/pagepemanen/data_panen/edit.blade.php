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
                                <li class="breadcrumb-item" aria-current="page">Form Edit Data Panen</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Edit Data Panen</h2>
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
                            <h5>Form Edit Data Panen</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('datapanen.update', $datapanen->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="form-label">Nama Blok</label>
                                    <input type="text" name="nama_blok" id="nama_blok" class="form-control" required
                                        value="{{ old('nama_blok', $datapanen->nama_blok) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No TPH</label>
                                    <input type="text" name="no_tph" id="no_tph" class="form-control" required
                                        value="{{ old('no_tph', $datapanen->no_tph) }}">
                                </div>
                                <div class="form-row d-flex flex-wrap justify-content-between">
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">Ripe</label>
                                        <input type="number" name="ripe" id="ripe" class="form-control" required
                                            value="{{ old('ripe', $datapanen->ripe) }}">
                                    </div>
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">Over Ripe</label>
                                        <input type="number" name="over_ripe" id="over_ripe" class="form-control" required
                                            value="{{ old('over_ripe', $datapanen->over_ripe) }}">
                                    </div>
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">Under Ripe</label>
                                        <input type="number" name="under_ripe" id="under_ripe" class="form-control"
                                            required value="{{ old('under_ripe', $datapanen->under_ripe) }}">
                                    </div>
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">EB</label>
                                        <input type="number" name="eb" id="eb" class="form-control" required
                                            value="{{ old('eb', $datapanen->eb) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jumlah Buah Per Blok</label>
                                    <input type="number" name="jumlah_buah_per_blok" id="jumlah_buah_per_blok"
                                        class="form-control" required readonly
                                        value="{{ old('jumlah_buah_per_blok', $datapanen->jumlah_buah_per_blok) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Brondolan</label>
                                    <input type="number" name="brondolan" id="brondolan" class="form-control" required
                                        value="{{ old('brondolan', $datapanen->brondolan) }}">
                                </div>
                                <div class="form-group">
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
        function hitungJumlahBuah() {
            const ripe = parseInt(document.getElementById('ripe').value) || 0;
            const overRipe = parseInt(document.getElementById('over_ripe').value) || 0;
            const underRipe = parseInt(document.getElementById('under_ripe').value) || 0;
            const eb = parseInt(document.getElementById('eb').value) || 0;
            const total = ripe + overRipe + underRipe + eb;
            document.getElementById('jumlah_buah_per_blok').value = total;
        }

        document.getElementById('ripe').addEventListener('input', hitungJumlahBuah);
        document.getElementById('over_ripe').addEventListener('input', hitungJumlahBuah);
        document.getElementById('under_ripe').addEventListener('input', hitungJumlahBuah);
        document.getElementById('eb').addEventListener('input', hitungJumlahBuah);
    </script>
@endsection
