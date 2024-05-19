@extends('layouts.index')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Edit Data Alumni</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Edit Data Alumni</li>
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

                        <h4 class="card-title">Edit Data Alumni</h4>
                        {{-- <p class="card-subtitle mb-4">Custom feedback styles apply custom colors, borders, focus styles, and background icons to better communicate feedback. Background icons for <code>&lt;select&gt;</code>s are only available with <code>.custom-select</code>, and not <code>.form-control</code>.</p> --}}
                        <form action="{{ route('alumni-update') }}" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <input type="hidden" name="id" value="{{ $alumni->nisn }}">
                                <input type="hidden" name="kategori" value="{{ $alumni->kategori }}">
                                <input type="hidden" name="jurusan" value="{{ $alumni->jurusan }}">
                                <input type="hidden" name="tuhun_lulus" value="{{ $alumni->tuhun_lulus }}">
                                <div class="col-md-6 mb-6">
                                    <label for="nisn">NISN</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn" value="{{ $alumni->nisn }}" placeholder="Nomor Induk Siswa Nasional" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="nama_alumni">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_alumni" name="nama_alumni" value="{{ $alumni->nama_alumni }}" placeholder="Nama lengkap" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki" {{ $alumni->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ $alumni->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="alamat_alumni">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_alumni" name="alamat_alumni" value="{{ $alumni->alamat_alumni }}" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="no_hp_alumni">No HP</label>
                                    <input type="text" class="form-control" id="no_hp_alumni" name="no_hp_alumni" value="{{ $alumni->no_hp_alumni }}" placeholder="No HP" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6 ">
                                    <label for="email_alumni">Email</label>
                                    <input type="email" class="form-control" id="email_alumni" name="email_alumni" value="{{ $alumni->email_alumni }}" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="foto_alumni">Foto</label>
                                    <input type="file" class="form-control" id="foto_alumni" name="foto_alumni" accept="image/jpeg, image/png">
                                    @if($alumni->foto_alumni)
                                        <img src="{{ asset('uploads/alumni/' . $alumni->foto_alumni) }}" alt="foto" width="100" class="mt-2">
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
