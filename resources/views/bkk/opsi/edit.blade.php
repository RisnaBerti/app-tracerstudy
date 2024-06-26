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
                        <form action="{{ route('opsi-update') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="id_opsi" name="id_opsi" value="{{ $opsi->id_opsi }}">
                                {{-- <input type="hidden" id="id_opsi" name="id_opsi" value=""> --}}
                                <div class="col-md-4 mb-12">
                                    <label for="id_pertanyaan">Pertanyaan</label>
                                    <select class="form-control" name="id_pertanyaan" id="id_pertanyaan" required>
                                        <option value="">Pilih Pertanyaan</option>
                                        @foreach ($pertanyaan as $item)
                                            <option value="{{ $item->id_pertanyaan }}" {{ $opsi->id_pertanyaan == $item->id_pertanyaan ? 'selected' : '' }}>
                                                {{ $item->pertanyaan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="opsi">Opsi Jawaban</label>
                                    <input type="text" class="form-control" id="opsi" name="opsi"
                                        placeholder="Opsi Jawaban" value="{{ $opsi->opsi }}" required>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
                            {{-- batal --}}
                            <a href="{{ route('opsi') }}" class="btn btn-light waves-effect waves-light">Batal</a>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->



    </div> <!-- container-fluid -->
@endsection
