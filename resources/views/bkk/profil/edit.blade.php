@extends('layouts.index-bkk')
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
                        <form method="POST" action="{{ route('update-profile-bkk') }}" class="needs-validation" novalidate  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-lg-4 text-center">
                                    <label for="foto_pegawai">Foto</label>
                                    <img src="{{ asset('uploads/pegawai/' . $pegawai->foto_pegawai) }}" class="img-thumbnail" width="50%" alt="foto pegawai">   
                                    <input type="file" class="form-control" id="foto_pegawai" name="foto_pegawai"
                                        accept="image/jpeg, image/png" required>
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <div class="form-group">
                                        <label class="title">NIP</label>
                                        <input type="text" class="form-control " name="nip" id="nip"
                                            value="{{ $pegawai->nip }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Nama Lengkap</label>
                                        <input type="text" class="form-control " name="nama_pegawai" id="nama_pegawai"
                                            value="{{ $pegawai->nama_pegawai }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki" {{ $pegawai->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="title">No HP</label>
                                        <input type="text" class="form-control " name="no_hp_pegawai" id="no_hp_pegawai"
                                            value="{{ $pegawai->no_hp_pegawai }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Email</label>
                                        <input type="text" class="form-control " name="email_pegawai" id="email_pegawai"
                                            value="{{ $pegawai->email_pegawai }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Alamat</label>
                                        <input type="text" class="form-control " name="alamat_pegawai" id="alamat_pegawai"
                                            value="{{ $pegawai->alamat_pegawai }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-8">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                </div>
                            </div>
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

                        <form method="POST" action="{{ route('update-password-bkk') }}"  class="form-horizontal">
                            @csrf
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
                                <label for="konfirmasiPasswordBaru" class="col-3 col-form-label">Konfirmasi Password Baru</label>
                                <div class="col-9">
                                    <input type="password" class="form-control" id="konfirmasiPasswordBaru" name="konfirmasiPasswordBaru"
                                        placeholder="Konfirmasi Password Baru">
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
