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
                                <li class="breadcrumb-item"><a href="/dashboard-kerani">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Rekap Pengiriman</a></li>
                                <li class="breadcrumb-item" aria-current="page">Form Edit Data Rekap Pengiriman</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Edit Data Rekap Pengiriman</h2>
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
                            <h5>Form Edit Data Rekap Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('data-rekap-pengiriman.update', $dataRekapPengiriman->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Blok</label>
                                    <select name="blok_id" id="blok_id" class="form-control" required>
                                        <option value="">Pilih Blok</option>
                                        @foreach ($blok as $item)
                                            <option value="{{ $item->id }}" {{ $dataRekapPengiriman->blok_id == $item->id ? 'selected' : '' }}>{{ $item->blok }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No TPH</label>
                                    <input type="text" name="no_tph" id="no_tph" class="form-control" value="{{ $dataRekapPengiriman->no_tph }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kode Panen</label>
                                        <input type="text" name="kode_panen" id="kode_panen" class="form-control" value="{{ $dataRekapPengiriman->kode_panen }}" required>
                                </div>
                                <div class="form-row d-flex flex-wrap justify-content-between">
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">Ripe</label>
                                        <input type="number" name="ripe" id="ripe" class="form-control" value="{{ $dataRekapPengiriman->ripe }}" required>
                                    </div>
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">Over</label>
                                        <input type="number" name="over" id="over" class="form-control" value="{{ $dataRekapPengiriman->over }}" required>
                                    </div>
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">UR</label>
                                        <input type="number" name="ur" id="ur" class="form-control" value="{{ $dataRekapPengiriman->ur }}" required>
                                    </div>
                                    <div class="form-group flex-fill me-2 mb-3">
                                        <label class="form-label">UDR</label>
                                        <input type="number" name="udr" id="udr" class="form-control" value="{{ $dataRekapPengiriman->udr }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Total</label>
                                    <input type="number" name="total" id="total" class="form-control" value="{{ $dataRekapPengiriman->total }}" readonly required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">BRD</label>
                                    <input type="number" name="brd" id="brd" class="form-control" value="{{ $dataRekapPengiriman->brd }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">BS</label>
                                    <input type="number" name="bs" id="bs" class="form-control" value="{{ $dataRekapPengiriman->bs }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">BJr</label>
                                    <input type="text" name="bjr" id="bjr" class="form-control" value="{{ $dataRekapPengiriman->bjr }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">SPH</label>
                                        <input type="number" name="sph" id="sph" class="form-control" value="{{ $dataRekapPengiriman->blok->sph }}" readonly required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">AKP Actual (%)</label>
                                    <input type="number" name="akp_actual" id="akp_actual" class="form-control" value="{{ $dataRekapPengiriman->akp_actual }}" readonly required>
                                </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary me-2">Update</button>
                                        <a href="{{ route('data-rekap-pengiriman.index') }}" class="btn btn-light">Kembali</a>
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
        function hitungTotal() {
            const ripe = parseInt(document.getElementById('ripe').value) || 0;
            const over = parseInt(document.getElementById('over').value) || 0;
            const ur = parseInt(document.getElementById('ur').value) || 0;
            const udr = parseInt(document.getElementById('udr').value) || 0;
            const total = ripe + over + ur + udr;
            document.getElementById('total').value = total;
            hitungAKPActual();
        }

        function hitungAKPActual() {
            const total = parseInt(document.getElementById('total').value) || 0;
            const sph = parseInt(document.getElementById('sph').value) || 0;
            
            if (sph > 0) {
                const akpActual = (total / sph) * 100;
                document.getElementById('akp_actual').value = akpActual.toFixed(2);
            } else {
                document.getElementById('akp_actual').value = '';
            }
        }

        // Fungsi untuk mengambil data SPH dan BJr dari blok yang dipilih
        function getBlokData() {
            const blokId = document.getElementById('blok_id').value;
            if (blokId) {
                fetch(`/get-blok-sph/${blokId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('sph').value = data.sph;
                        hitungAKPActual(); // Hitung ulang AKP Actual setelah SPH berubah
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                // Reset nilai jika tidak ada blok yang dipilih
                document.getElementById('sph').value = '';
                document.getElementById('akp_actual').value = '';
            }
        }

        // Hitung total dan AKP Actual saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            hitungTotal();
            hitungAKPActual();
        });

        document.getElementById('ripe').addEventListener('input', hitungTotal);
        document.getElementById('over').addEventListener('input', hitungTotal);
        document.getElementById('ur').addEventListener('input', hitungTotal);
        document.getElementById('udr').addEventListener('input', hitungTotal);
        document.getElementById('sph').addEventListener('input', hitungAKPActual);
        document.getElementById('blok_id').addEventListener('change', getBlokData);
    </script>
@endsection
