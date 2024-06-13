@extends('layouts.index-bkk')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Tambah {{ $title }}</h4>

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

                        <h4 class="card-title">Tambah Data Alumni</h4>
                        {{-- <p class="card-subtitle mb-4">Custom feedback styles apply custom colors, borders, focus styles, and background icons to better communicate feedback. Background icons for <code>&lt;select&gt;</code>s are only available with <code>.custom-select</code>, and not <code>.form-control</code>.</p> --}}
                        <form action="{{ route('tahun-lulus-store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                @csrf
                                <div class="col-md-4 mb-6">
                                    <label for="tahun_lulus">Tahun Kelulusan</label>
                                    <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus"
                                        placeholder="Tahun Kelulusan" value="" required>
                                    {{-- <div class="valid-feedback">
                                        Looks good!
                                    </div> --}}
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
                            {{-- batal --}}
                            <a href="{{ route('tahun-lulus') }}" class="btn btn-light waves-effect waves-light">Batal</a>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->



    </div> <!-- container-fluid -->
@endsection
