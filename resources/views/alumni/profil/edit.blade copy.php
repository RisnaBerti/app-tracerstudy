@extends('layouts.index-humas')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">{{ $title }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
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

                        <h4 class="card-title">Edit Data Profil</h4>
                        <form method="POST" action="{{ route('update-profile-humas') }}" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-sm-12 col-lg-4">
                                    <img src="" class="img-thumbnail" alt="foto alumni">
                                    <label for="foto_alumni">Foto</label>
                                    <input type="file" class="form-control" id="foto_alumni" name="foto_alumni">
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <div class="form-group">
                                        <label class="title">NIP</label>
                                        <input type="text" class="form-control " name="nisn" id="nisn"
                                            value="{{ $pegawai->nip }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Nama Lengkap</label>
                                        <input type="text" class="form-control " name="nama_alumni" id="nama_alumni"
                                            value="{{ $pegawai->nama_pegawai }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Jurusan</label>
                                        <input type="text" class="form-control " name="id_jurusan" id="id_jurusan"
                                            value="{{ $pegawai-> }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Tahun Lulus</label>
                                        <input type="text" class="form-control " name="id_tahun_lulus"
                                            id="id_tahun_lulus" value="{{ $pegawai-> }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Jenis Kelamin</label>
                                        <input type="text" class="form-control " name="jenis_kelamin" id="jenis_kelamin"
                                            value="{{ $pegawai-> }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">No HP</label>
                                        <input type="text" class="form-control " name="no_hp_alumni" id="no_hp_alumni"
                                            value="{{ $pegawai-> }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Email</label>
                                        <input type="text" class="form-control " name="email_alumni" id="email_alumni"
                                            value="{{ $pegawai-> }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Alamat</label>
                                        <input type="text" class="form-control " name="alamat_alumni" id="alamat_alumni"
                                            value="{{ $pegawai-> }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="validationCustom01">First name</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="First name"
                                    value="Mark" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Ganti Password</h4>

                        <form method="POST" action="{{ route('update-password-humas') }}"  class="form-horizontal">
                            <div class="form-group row mb-3">
                                <label for="passwordLama" class="col-3 col-form-label">Password Lama</label>
                                <div class="col-9">
                                    <input type="password" class="form-control" id="passwordLama" name="passwordLama"
                                        placeholder="Password Lama">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="passwordBaru" class="col-3 col-form-label">Password Baru</label>
                                <div class="col-9">
                                    <input type="password" class="form-control" id="passwordBaru" name="passwordBaru"
                                        placeholder="Password Baru">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="konfirmasiPasswordBaru" class="col-3 col-form-label">Konfirmasi Password
                                    Baru</label>
                                <div class="col-9">
                                    <input type="password" class="form-control" id="konfirmasiPasswordBaru" name="konfirmasiPasswordBaru"
                                        placeholder="Konfirmasi Password
                                        Baru">
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
@endsection
