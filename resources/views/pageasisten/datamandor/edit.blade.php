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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Mandor</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Edit Data Mandor</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Data Mandor</h2>
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
              <h5>Form Edit Data Mandor</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('datamandor.update', $mandor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="form-group">
                  <label class="form-label">Nama Mandor</label>
                  <input type="text" name="nama" class="form-control" value="{{ $mandor->nama }}" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Npk Mandor</label>
                  <input type="text" name="npk" class="form-control" value="{{ $mandor->npk }}" required>
                  <small>Npk Mandor harus berupa angka.</small>
                </div>
                <div class="form-group">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Password (isi jika ingin mengganti)</label>
                  <input type="password" name="password" class="form-control" placeholder="Password baru">
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