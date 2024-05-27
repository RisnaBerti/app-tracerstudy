@extends('layouts.index-bkk')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">{{ $title }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            {{-- Tombol nav-tabs hasil 1, hasil 2, hasil 3, hasil 4, hasil 5 --}}
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview-bkk', ['id' => $id]) }}" class="nav-link ">Grafik Pengisian</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview2', ['id' => $id]) }}" class="nav-link ">Grafik Alumni</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview3', ['id' => $id]) }}" class="nav-link">Bekerja</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview4', ['id' => $id]) }}" class="nav-link active">Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview5', ['id' => $id]) }}" class="nav-link">Wirausaha</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview6', ['id' => $id]) }}" class="nav-link">Belum Bekerja</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title
                        ">Preview Kuliah</h4>
                        {{-- <p class="card-title-desc">Preview Kuliah</p> --}}
                        
                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Perguruan Tinggi</th>
                                    <th>Jurusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $nama_alumni => $jawaban)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nama_alumni }}</td>
                                        <td>{{ $jawaban['Di perguruan tinggi mana anda melanjutkan pendidikan?'] ?? 'N/A' }}</td>
                                        <td>{{ $jawaban['Jurusan apa yang anda ambil di perguruan tinggi tersebut?'] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div>
            {{-- <div class="col-sm-12 col-md-6">
            <div class="dt-buttons btn-group"> 
                <button class="btn btn-secondary buttons-copy buttons-html5"
                    tabindex="0" aria-controls="datatable-buttons" type="button"><span>Copy</span></button> <button
                    class="btn btn-secondary buttons-print" tabindex="0" aria-controls="datatable-buttons"
                    type="button"><span>Print</span></button> <button
                    class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="datatable-buttons"
                    type="button"><span>PDF</span></button> 
            </div>
        </div> --}}
          
        </div>
        <!-- end row-->

    </div> <!-- container-fluid -->
@endsection
