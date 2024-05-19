@extends('layouts.index')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Tambah Data Pegawai</h4>

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
                        <form action="{{ route('pegawai-store') }}" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip"
                                        placeholder="Nomor Induk Siswa Nasional" required>
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="nama_pegawai">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai"
                                        placeholder="Nama lengkap" value="" required>
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
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
                                    <label for="alamat_pegawai">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_pegawai" name="alamat_pegawai"
                                        placeholder="Alamat" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid city.</div> --}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="no_hp_pegawai">No HP</label>
                                    <input type="text" class="form-control" id="no_hp_pegawai" name="no_hp_pegawai"
                                        placeholder="No HP" value="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6 ">
                                    <label for="email_pegawai">Email</label>
                                    <input type="email" class="form-control" id="email_pegawai" name="email_pegawai"
                                        placeholder="Email" value="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="foto_pegawai">Foto</label>
                                    <input type="file" class="form-control" id="foto_pegawai" name="foto_pegawai"
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
