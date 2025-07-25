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
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Aktual AKP</a></li>
                                <li class="breadcrumb-item" aria-current="page">Form Edit Data Aktual AKP</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Edit Data Aktual AKP</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row justify-content-center">
                <!-- [ form-element ] start -->
                <div class="col-sm-6">
                    <!-- Basic Inputs -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Edit Data Aktual AKP</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('aktualakp.update', $aktualakp->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="mandor_id" value="{{ $aktualakp->mandor_id }}">
                                <div class="form-group">
                                    <label class="form-label">Nama Blok</label>
                                    <input type="text" name="nama_blok" id="nama_blok" class="form-control" placeholder="Nama Blok"
                                        value="{{ old('nama_blok', $aktualakp->nama_blok) }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">SPH (Satuan Per Hektar)</label>
                                    <input type="number" name="satuan_per_hektar" id="sph" class="form-control"
                                        placeholder="SPH (Satuan Per Hektar)" value="{{ old('satuan_per_hektar', $aktualakp->satuan_per_hektar) }}" required>
                                    <small>SPH harus berupa angka.</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jumlah Janjang</label>
                                    <input type="number" name="jumlah_janjang" id="jumlah_janjang" class="form-control"
                                        placeholder="Jumlah Janjang" value="{{ old('jumlah_janjang', $aktualakp->jumlah_janjang) }}" required>
                                    <small>Jumlah Janjang harus berupa angka.</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Total</label>
                                    <input type="number" name="total" id="total" class="form-control" placeholder="Total" value="{{ old('total', $aktualakp->total) }}" required readonly>
                                    <small>Total harus berupa angka.</small>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                    <a href="{{ route('akp.index') }}" class="btn btn-light">Batal</a>
                                </div>
                            </form>
                            <script>
                                const sphInput = document.getElementById('sph');
                                const janjangInput = document.getElementById('jumlah_janjang');
                                const totalInput = document.getElementById('total');

                                function hitungTotal() {
                                    const sph = parseFloat(sphInput.value) || 0;
                                    const janjang = parseFloat(janjangInput.value) || 0;
                                    let total = 0;
                                    if (sph > 0) {
                                        total = (janjang / sph) * 100;
                                    }
                                    totalInput.value = total ? total : '';
                                }

                                sphInput.addEventListener('input', hitungTotal);
                                janjangInput.addEventListener('input', hitungTotal);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
