@extends('layouts.index-disnaker')
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
                        {{-- tombol tambah  --}}
                        {{-- <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('kuesioner-create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus mr-2"></i> Tambah Data
                            </a>
                        </div> --}}

                        {{-- tombol print --}}
                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('statistik-disnaker-print', ['tahun' => $tahun]) }}" class="btn btn-primary" target="_blank">
                                <i class="mdi mdi-printer mr-2"></i> Print
                            </a>
                        </div>

                        {{-- tombol filter tahun --}}
                        <div class="d-flex justify-content-end mb-2">
                            
                            <form action="{{ route('statistik-disnaker') }}" method="GET">
                                <div class="input-group">
                                    <select class="form-control" name="tahun">
                                        <option value="">Pilih Tahun</option>
                                        @for ($i = 2020; $i <= date('Y'); $i++)
                                            <option value="{{ $i }}" @if ($i == $tahun) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Jumlah Alumni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalAlumni = 0;
                                @endphp
                                @foreach ($alumniPerJurusanPerTahun as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama_jurusan }}</td>
                                        <td>{{ $item->tahun_lulus }}</td>
                                        <td>{{ $item->jumlah_alumni }}</td>
                                    </tr>
                                    @php
                                        $totalAlumni += $item->jumlah_alumni;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td>{{ $totalAlumni }}</td>
                                </tr>
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
