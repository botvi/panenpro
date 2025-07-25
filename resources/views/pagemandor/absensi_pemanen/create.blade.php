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
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Absensi Pemanen</a></li>
                                <li class="breadcrumb-item" aria-current="page">Form Tambah Data Absensi Pemanen</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Tambah Data Absensi Pemanen</h2>
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
                            <h5>Form Tambah Data Absensi Pemanen</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('absensipemanen.store') }}" method="POST">
                                @csrf                                
                                <div class="form-group">
                                    <label class="form-label">Nama Pemanen</label>
                                    <select name="pemanen_id" id="pemanen_id" class="form-control" required>
                                        <option value="">Pilih Pemanen</option>
                                        @foreach ($pemanen as $item)
                                            <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Keterangan</label>
                                    <select name="keterangan" id="keterangan" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="P(Panen)">P(Panen)</option>
                                        <option value="M(Mangkir)">M(Mangkir)</option>
                                        <option value="S(Sakit)">S(Sakit)</option>
                                        <option value="C(Cuti)">C(Cuti)</option>
                                        <option value="R(Rawat)">R(Rawat)</option>
                                    </select>
                                    <small>Pilih keterangan (P(Panen), M(Mangkir), S(Sakit), C(Cuti), R(Rawat)).</small>
                                </div>
                                
                               
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
