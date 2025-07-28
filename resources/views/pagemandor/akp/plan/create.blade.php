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
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Plan AKP</a></li>
                                <li class="breadcrumb-item" aria-current="page">Form Tambah Data Plan AKP</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Tambah Data Plan AKP</h2>
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
                            <h5>Form Tambah Data Plan AKP</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('planakp.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="mandor_id" value="{{ auth()->user()->id }}">
                                <div class="form-group">
                                    <label class="form-label">Nama Blok</label>
                                    <input type="text" name="nama_blok" id="nama_blok" class="form-control" placeholder="Nama Blok"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">SPH (Satuan Per Hektar)</label>
                                    <input type="number" name="satuan_per_hektar" id="sph" class="form-control"
                                        placeholder="SPH (Satuan Per Hektar)" required>
                                    <small>SPH harus berupa angka.</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jumlah Janjang</label>
                                    <input type="number" name="jumlah_janjang" id="jumlah_janjang" class="form-control"
                                        placeholder="Jumlah Janjang" required>
                                    <small>Jumlah Janjang harus berupa angka.</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Total (Persentase)</label>
                                    <input type="text" name="total" id="total" class="form-control" placeholder="Total" required readonly>
                                    <small>Total harus berupa angka.</small>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <button type="reset" class="btn btn-light">Reset</button>
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
                                        total = ((janjang / sph) * 100/100).toFixed(2);
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
