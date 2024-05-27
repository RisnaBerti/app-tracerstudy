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
                        <a href="" class="nav-link">Hasil 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Hasil 2</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Hasil 3</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Hasil 4</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link active">Hasil 5</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title
                        ">{{ $title }}</h4>
                        <p class="card-title-desc">Hasil 5</p>
                        
                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Perusahaan</th>
                                    <th>Posisi</th>
                                    <th>Hasil</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($hasil as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->perusahaan }}</td>
                                        <td>{{ $item->posisi }}</td>
                                        <td>{{ $item->hasil }}</td>
                                        <td>
                                            <a href="{{ route('kuesioner.detail', $item->id_kuesioner) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach --}}
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
