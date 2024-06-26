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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Kuesioner</th>
                                    {{-- <th>Periode Pengisian</th> --}}
                                    <th>Judul Kuesioner</th>
                                    <th>Deskripsi Kuesioner</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kuesioner as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_kuesioner)->format('d-m-Y') }}</td>
                                        <td>{{ $item->judul_kuesioner }}</td>
                                        <td>{{ $item->deskripsi_kuesioner }}</td>
                                        <td>
                                            {{-- Debug: Output the isSubmitted status --}}
                                            <span
                                                style="display:none;">{{ $item->isSubmitted ? 'Submitted' : 'Not Submitted' }}</span>

                                            @if ($item->isSubmitted)
                                                <a href="{{ route('kuesioner-alumni-edit', $item->id_kuesioner) }}"
                                                    class="btn btn-warning">
                                                    Edit <i class="mdi mdi-pencil"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('kuesioner-alumni-show', $item->id_kuesioner) }}"
                                                    class="btn btn-success">
                                                    Isi Kuesioner <i class="mdi mdi-pencil"></i>
                                                </a>
                                            @endif
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
    <script>
        $(document).ready(function() {
            $('#basic-datatable').DataTable();
        });
    </script>
@endsection
