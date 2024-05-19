@extends('layouts.index')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Tambah Data Alumni</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Tambah {{ $title }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah {{ $title }}</h4>
                        {{-- <p class="card-subtitle mb-4">Custom feedback styles apply custom colors, borders, focus styles, and background icons to better communicate feedback. Background icons for <code>&lt;select&gt;</code>s are only available with <code>.custom-select</code>, and not <code>.form-control</code>.</p> --}}
                        <form action="{{ route('alumni-store') }}" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-6">                                    
                                {{-- <input type="hidden" name="kategori" id="kategori" value="-">
                                <input type="hidden" name="jurusan" id="jurusan" value="-">
                                <input type="hidden" name="tuhun_lulus" id="tuhun_lulus" value="-"> --}}
                                    <label for="nisn">NISN</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn"
                                        placeholder="Nomor Induk Siswa Nasional" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="nama_alumni">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_alumni" name="nama_alumni"
                                        placeholder="Nama lengkap" value="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="alamat_alumni">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_alumni" name="alamat_alumni"
                                        placeholder="Alamat" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid city.</div> --}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="no_hp_alumni">No HP</label>
                                    <input type="text" class="form-control" id="no_hp_alumni" name="no_hp_alumni"
                                        placeholder="No HP" value="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6 ">
                                    <label for="email_alumni">Email</label>
                                    <input type="email" class="form-control" id="email_alumni" name="email_alumni"
                                        placeholder="Email" value="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="foto_alumni">Foto</label>
                                    <input type="file" class="form-control" id="foto_alumni" name="foto_alumni"
                                        accept="image/jpeg, image/png" required>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
                        </form>


                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container-fluid -->
@endsection
