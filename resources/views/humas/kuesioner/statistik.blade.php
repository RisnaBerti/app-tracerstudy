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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>

                        {{-- tombol print --}}
                        <div class="d-flex justify-content-end mb-2">
                            {{-- <a href="{{ route('statistik-humas-print', ['tahun' => $tahun]) }}" class="btn btn-primary"
                                target="_blank">
                                <i class="mdi mdi-printer mr-2"></i> Print
                            </a> --}}
                            <a href="{{ route('statistik-humas-print-excel') }}" class="btn btn-primary"
                                target="_blank">
                                <i class="mdi mdi-printer mr-2"></i> EXPORT EXCEL
                            </a>
                            {{-- <a href="/siswa/export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a> --}}
                        </div>

                        {{-- tombol filter tahun --}}
                        <div class="d-flex justify-content-end mb-2">
                            <form action="{{ route('statistik-humas') }}" method="GET">
                                <div class="input-group">
                                    <select class="form-control" name="tahun">
                                        <option value="">Pilih Tahun</option>
                                        @for ($i = 2020; $i <= date('Y'); $i++)
                                            <option value="{{ $i }}"
                                                @if ($i == $tahun) selected @endif>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="width:100%">
                                {{-- <table id="basic-datatable" class="table dt-responsive nowrap"> --}}
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NISN</th>
                                        <th>Jurusan</th>
                                        <th>Tahun Lulus</th>
                                        <th>Kuesioner</th>
                                        <th>Status</th>
                                        <!-- Kolom jawaban pertanyaan akan ditambahkan secara dinamis -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container-fluid -->

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('statistik-humas') }}",
                type: 'GET',
                success: function(response) {
                    if (response.error) {
                        console.error('Error:', response.error);
                        return;
                    }
    
                    var pertanyaan = response.pertanyaan;
                    var columns = [
                        { data: 'no', name: 'no' },
                        { data: 'nama_alumni', name: 'nama_alumni' },
                        { data: 'nisn', name: 'nisn' },
                        { data: 'nama_jurusan', name: 'nama_jurusan' },
                        { data: 'tahun_lulus', name: 'tahun_lulus' },
                        { data: 'judul_kuesioner', name: 'judul_kuesioner' },
                        { data: 'nama_kategori', name: 'nama_kategori' }
                    ];
    
                    var thead = $('#basic-datatable thead tr');
                    for (var i = 0; i < pertanyaan.length; i++) {
                        thead.append('<th>' + pertanyaan[i] + '</th>');
                        columns.push({
                            data: pertanyaan[i], // Use the question text as the key to access the answers
                            render: function(data, type, full, meta) {
                                return data || '-';
                            },
                            name: 'pertanyaan_' + (i + 1)
                        });
                    }
    
                    // Inisialisasi DataTables dengan kolom dinamis
                    $('#basic-datatable').DataTable({
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('statistik-humas') }}",
                            type: 'GET',
                            dataSrc: function(json) {
                                return json.data;
                            }
                        },
                        columns: columns
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan dalam mengambil data: ' + error);
                }
            });
        });
    </script>
    
@endsection
