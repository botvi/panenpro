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
                                <li class="breadcrumb-item" aria-current="page">Form Edit Data Grafik Kepatuhan</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Edit Data Grafik Kepatuhan</h2>
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
                            <h5>Form Edit Data Grafik Kepatuhan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('grafikkepatuhan.update', $grafikkepatuhan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="mandor_id" value="{{ auth()->user()->id }}">
                                
                                <div class="form-group">
                                    <label class="form-label">Nama Pemanen</label>
                                    <select name="pemanen_id" id="pemanen_id" class="form-control" required>
                                        <option value="">Pilih Pemanen</option>
                                        @foreach ($pemanen as $item)
                                            <option value="{{ $item->user_id }}" {{ $grafikkepatuhan->pemanen_id == $item->user_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Keluar Buah</label>
                                    <select name="keluar_buah" id="keluar_buah" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="Kurang dari 9" {{ $grafikkepatuhan->keluar_buah == 'Kurang dari 9' ? 'selected' : '' }}>Kurang dari 9</option>
                                        <option value="Lebih dari 9" {{ $grafikkepatuhan->keluar_buah == 'Lebih dari 9' ? 'selected' : '' }}>Lebih dari 9</option>
                                    </select>
                                    <small>Pilih jumlah keluar buah (Kurang dari 9 atau Lebih dari 9).</small>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Alas Karung Brondol</label>
                                    <select name="alas_karung_brondol" id="alas_karung_brondol" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="Ya" {{ $grafikkepatuhan->alas_karung_brondol == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ $grafikkepatuhan->alas_karung_brondol == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    <small>Pilih Ya atau Tidak untuk Alas Karung Brondol.</small>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Panen Blok 17</label>
                                    <select name="panen_blok_17" id="panen_blok_17" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="Ya" {{ $grafikkepatuhan->panen_blok_17 == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ $grafikkepatuhan->panen_blok_17 == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    <small>Pilih Ya atau Tidak untuk Panen Blok 17.</small>
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
