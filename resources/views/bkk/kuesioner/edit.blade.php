@extends('layouts.index-bkk')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Edit {{ $title }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Edit {{ $title }}</li>
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

                        <h4 class="card-title">Edit {{ $title }}</h4>
                        {{-- <p class="card-subtitle mb-4">Custom feedback styles apply custom colors, borders, focus styles, and background icons to better communicate feedback. Background icons for <code>&lt;select&gt;</code>s are only available with <code>.custom-select</code>, and not <code>.form-control</code>.</p> --}}
                        <form action="{{ route('kuesioner-update') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <input type="hidden" name="id_kuesioner" value="{{ $kuesioner->id_kuesioner }}">
                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="tgl_kuesioner">Tanggal Kuesioner</label>
                                    <input type="text" class="form-control" id="tgl_kuesioner" name="tgl_kuesioner"
                                        placeholder="Tanggal Kuesioner" value="{{ $kuesioner->tgl_kuesioner }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="judul_kuesioner">Nama Kuesioner</label>
                                    <input type="text" class="form-control" id="judul_kuesioner" name="judul_kuesioner"
                                        placeholder="Nama Kuesioner" value="{{ $kuesioner->judul_kuesioner }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="tahun_lulus_awal">Tahun Lulus Awal</label>
                                    <select class="form-control" id="tahun_lulus_awal" name="tahun_lulus_awal" required>
                                        <option value="">Pilih Tahun Lulus Awal</option>
                                        @for ($year = 1900; $year <= date('Y'); $year++)
                                            <option value="{{ $year }}" {{ (old('tahun_lulus_awal', $kuesioner->tahun_lulus_awal) == $year) ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="tahun_lulus_akhir">Tahun Lulus Akhir</label>
                                    <select class="form-control" id="tahun_lulus_akhir" name="tahun_lulus_akhir" required>
                                        <option value="">Pilih Tahun Lulus Akhir</option>
                                        @for ($year = 1900; $year <= date('Y'); $year++)
                                            <option value="{{ $year }}" {{ (old('tahun_lulus_akhir', $kuesioner->tahun_lulus_akhir) == $year) ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="deskripsi_kuesioner">Deskripsi Kuesioner</label>
                                    <input type="text" class="form-control" id="deskripsi_kuesioner"
                                        name="deskripsi_kuesioner" placeholder="Deskripsi Kuesioner" value="{{ $kuesioner->deskripsi_kuesioner }}"
                                        required>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
                            {{-- batal --}}
                            <a href="{{ route('kuesioner') }}" class="btn btn-light waves-effect waves-light">Batal</a>
                        </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->



    </div> <!-- container-fluid -->
@endsection
