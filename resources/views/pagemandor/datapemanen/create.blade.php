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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Pemanen</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Tambah Data Pemanen</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Data Pemanen</h2>
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
              <h5>Form Tambah Data Pemanen</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('datapemanen.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label class="form-label">Nama Pemanen</label>
                  <input type="text" name="nama" class="form-control" placeholder="Nama Pemanen" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Npk Pemanen</label>
                  <input type="text" name="npk" class="form-control" placeholder="Npk Pemanen" required>
                  <small>Npk Pemanen harus berupa angka.</small>
                </div>
                <div class="form-group">
                  <label class="form-label">Kode Panen</label>
                  <input type="text" name="kode_panen" class="form-control" placeholder="Kode Panen" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Estate</label>
                  <input type="text" name="estate" class="form-control" placeholder="Estate" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Konfirmasi Password</label>
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
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
    </div>
  </section>
@endsection