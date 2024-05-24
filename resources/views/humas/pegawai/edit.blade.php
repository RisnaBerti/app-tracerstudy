@extends('layouts.index-humas')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Edit Data Pegawai</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Edit Data Pegawai</li>
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

                        <h4 class="card-title">Edit Data Pegawai</h4>
                        {{-- <p class="card-subtitle mb-4">Custom feedback styles apply custom colors, borders, focus styles, and background icons to better communicate feedback. Background icons for <code>&lt;select&gt;</code>s are only available with <code>.custom-select</code>, and not <code>.form-control</code>.</p> --}}
                        <form action="{{ route('pegawai-update') }}" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <input type="hidden" name="id" value="{{ $pegawai->nip }}">
                                <div class="col-md-6 mb-6">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip" value="{{ $pegawai->nip }}" placeholder="Nomor Induk Siswa Nasional" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="nama_pegawai">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="{{ $pegawai->nama_pegawai }}" placeholder="Nama lengkap" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki" {{ $pegawai->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="alamat_pegawai">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_pegawai" name="alamat_pegawai" value="{{ $pegawai->alamat_pegawai }}" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="no_hp_pegawai">No HP</label>
                                    <input type="text" class="form-control" id="no_hp_pegawai" name="no_hp_pegawai" value="{{ $pegawai->no_hp_pegawai }}" placeholder="No HP" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6 ">
                                    <label for="email_pegawai">Email</label>
                                    <input type="email" class="form-control" id="email_pegawai" name="email_pegawai" value="{{ $pegawai->email_pegawai }}" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6 ">
                                    <label for="id_role">Jabatan</label>
                                    <select class="form-control" id="id_role" name="id_role" required>
                                        <option value="1" {{ $pegawai->id_role == 'BKK' ? 'selected' : '' }}>BKK</option>
                                        <option value="3" {{ $pegawai->id_role == 'Disnaker' ? 'selected' : '' }}>Disnaker</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="foto_pegawai">Foto</label>
                                    <input type="file" class="form-control" id="foto_pegawai" name="foto_pegawai" accept="image/jpeg, image/png">
                                    @if($pegawai->foto_pegawai)
                                        <img src="{{ asset('uploads/pegawai/' . $pegawai->foto_pegawai) }}" alt="foto" width="100" class="mt-2">
                                    @endif
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
