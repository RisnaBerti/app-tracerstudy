@extends('layouts.index')
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
                        <form action="{{ route('tahun-lulus-update') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id_tahun_lulus" value="{{ $tahunLulus->id_tahun_lulus }}">
                                <div class="col-md-4 mb-12">
                                    <label for="tahun_lulus">Nama Jurusan</label>
                                    <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus" placeholder="Tahun Kelulusan" value="{{ $tahunLulus->tahun_lulus }}" required>
                                    {{-- <div class="valid-feedback">
                                        Looks good!
                                    </div> --}}
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
