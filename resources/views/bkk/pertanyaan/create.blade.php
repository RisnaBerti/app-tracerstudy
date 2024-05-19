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

                        <h4 class="card-title">Tambah {{ $title }}</h4>
                        {{-- <p class="card-subtitle mb-4">Custom feedback styles apply custom colors, borders, focus styles, and background icons to better communicate feedback. Background icons for <code>&lt;select&gt;</code>s are only available with <code>.custom-select</code>, and not <code>.form-control</code>.</p> --}}
                        <form action="{{ route('pertanyaan-store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="id_kuesioner">Judul Kuesioner</label>
                                    {{-- <input type="date" class="form-control" id="id_kuesioner" name="id_kuesioner"
                                        placeholder="Judul Kuesioner" value="" required> --}}
                                    <select class="form-control" id="id_kuesioner" name="id_kuesioner" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="pertanyaan">Pertanyaan</label>
                                    <input type="date" class="form-control" id="pertanyaan" name="pertanyaan"
                                        placeholder="Pertanyaan" value="" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="tipe_pertanyaan">Tipe Pertanyaan</label>
                                    <select class="form-control" id="tipe_pertanyaan" name="tipe_pertanyaan" required>
                                        <option value="">Tipe Pertanyaan</option>
                                        <option value="choice">choice</option>
                                        <option value="checkbox">checkbox</option>
                                        <option value="input">input</option>
                                    </select>
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
