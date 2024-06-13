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
                        <form action="{{ route('pertanyaan-update') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <input type="hidden" name="id_pertanyaan" value="{{ $pertanyaan->id_pertanyaan }}">
                                    <label for="id_kuesioner">Judul Kuesioner</label>
                                    <input type="text" class="form-control" id="id_kuesioner" name="id_kuesioner"
                                        placeholder="Judul Kuesioner" value="{{ $pertanyaan->kuesioner->judul_kuesioner }}" readonly required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="id_kategori">Kategori</label>
                                    <select class="form-control" id="id_kategori" name="id_kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id_kategori }}"
                                                {{ $pertanyaan->id_kategori == $item->id_kategori ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="pertanyaan">Pertanyaan</label>
                                    <input type="text" class="form-control" id="pertanyaan" name="pertanyaan"
                                        placeholder="Pertanyaan" value="{{ $pertanyaan->pertanyaan }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 mb-12">
                                    <label for="tipe_pertanyaan">Tipe Pertanyaan</label>
                                    <select class="form-control" id="tipe_pertanyaan" name="tipe_pertanyaan" required>
                                        <option value="Pilihan"
                                            {{ $pertanyaan->tipe_pertanyaan == 'Pilihan' ? 'selected' : '' }}>Pilihan
                                        </option>
                                        <option value="Textarea"
                                            {{ $pertanyaan->tipe_pertanyaan == 'Textarea' ? 'selected' : '' }}>Textarea
                                        </option>
                                        <option value="Text"
                                            {{ $pertanyaan->tipe_pertanyaan == 'Text' ? 'selected' : '' }}>Text
                                        </option>
                                    </select>
                                    {{-- <input type="text" class="form-control" id="tipe_pertanyaan"
                                        name="tipe_pertanyaan" placeholder="Deskripsi Kuesioner" value="{{ $pertanyaan->tipe_pertanyaan }}"
                                        required> --}}

                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
                            {{-- batal --}}
                            <a href="{{ route('pertanyaan') }}"
                                class="btn btn-light waves-effect waves-light">Batal</a>

                        </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->



    </div> <!-- container-fluid -->
@endsection
