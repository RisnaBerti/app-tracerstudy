@extends('layouts.index')
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('tahun-lulus-create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus mr-2"></i> Tambah Data
                            </a>
                        </div>

                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Kelulusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tahunLulus as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->tahun_lulus }}</td>
                                        <td>
                                            <a href="{{ route('tahun-lulus-edit', $item->id_tahun_lulus) }}"
                                                class="btn btn-warning">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="{{ route('tahun-lulus-delete', $item->id_tahun_lulus) }}"
                                                id="deletebutton" class="btn btn-danger delete-button">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container-fluid -->
@endsection
