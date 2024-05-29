@extends('layouts.index-humas')
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

                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Kuesioner</th>
                                    <th>Judul Kuesioner</th>
                                    <th>Deskripsi Kuesioner</th>
                                    {{-- <th>Sudah Mengisi</th> --}}
                                    <th>Preview</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kuesioner as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->tgl_kuesioner }}</td>
                                        <td>{{ $item->judul_kuesioner }}</td>
                                        <td>{{ $item->deskripsi_kuesioner }}</td>
                                        {{-- <td>{{ $jumlahMengisi[$item->id_kuesioner] }}</td> --}}
                                        <td>
                                            <a href="{{ route('hasil-preview-humas', $item->id_kuesioner) }}"
                                                class="btn btn-primary">
                                                <i class="mdi mdi-file-document-box-search-outline mdi-18px"> Preview</i>
                                            </a>
                                            </a>
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('notifikasi', $item->id_kuesioner) }}"
                                                class="btn btn-success">
                                                <i class="mdi mdi-comment-text-multiple mdi-18px"> Kirim Pesan</i>
                                            </a>
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
    <script>
        $(document).ready(function() {
            $('#basic-datatable').DataTable();
        });
    </script>
@endsection
