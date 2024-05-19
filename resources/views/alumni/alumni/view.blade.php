@extends('layouts.index-alumni')
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
                        <h4 class="card-title">Data Alumni</h4>

                        {{-- tombol tambah  --}}
                        {{-- <a href="{{ route('alumni-create') }}" class="btn btn-primary mb-2">
                            <i class="mdi mdi-plus mr-2"></i> Tambah Data
                        </a> --}}

                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Lulusan</th>
                                    <th>Jurusan</th>
                                    <th>JK</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alumni as $item)
                                    <tr>
                                        <td>{{ $item->nama_alumni }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->id_jurusan }}</td>
                                        <td>{{ $item->id_tahun_lulus }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->alamat_alumni }}</td>
                                        <td>{{ $item->no_hp_alumni }}</td>
                                        <td>{{ $item->email_alumni }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/alumni/' . $item->foto_alumni) }}" alt="foto"
                                                width="60">
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('alumni-edit', $item->nisn) }}" class="btn btn-warning">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="{{ route('alumni-delete', $item->nisn) }}" data-confirm-delete="true"
                                                class="btn btn-danger">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td> --}}
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
