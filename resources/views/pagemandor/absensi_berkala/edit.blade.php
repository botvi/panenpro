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
                                <li class="breadcrumb-item" aria-current="page">Form Edit Data Absensi Berkala</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Edit Data Absensi Berkala</h2>
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
                            <h5>Form Edit Data Absensi Berkala</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('absensiberkala.update', $absensiBerkala->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label class="form-label">Nama Pemanen</label>
                                    <select name="pemanen_id" id="pemanen_id" class="form-control" required>
                                        <option value="">Pilih Pemanen</option>
                                        @foreach ($pemanen as $item)
                                            <option value="{{ $item->user_id }}" {{ $absensiBerkala->pemanen_id == $item->user_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Blok</label>
                                    <input type="text" name="blok" id="blok" class="form-control" value="{{ $absensiBerkala->blok }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Baris</label>
                                    <input type="text" name="baris" id="baris" class="form-control" value="{{ $absensiBerkala->baris }}" required>       
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Arah Masuk</label>
                                    <select name="arah_masuk" id="arah_masuk" class="form-control" required>
                                        <option value="">Pilih Arah Masuk</option>
                                        <option value="Barat" {{ $absensiBerkala->arah_masuk == 'Barat' ? 'selected' : '' }}>Barat</option>
                                        <option value="Timur" {{ $absensiBerkala->arah_masuk == 'Timur' ? 'selected' : '' }}>Timur</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jam</label>
                                    <input type="time" name="jam" id="jam" class="form-control" value="{{ $absensiBerkala->jam }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Luasan</label>
                                    <input type="text" name="luasan" id="luasan" class="form-control" value="{{ $absensiBerkala->luasan }}" required>
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
