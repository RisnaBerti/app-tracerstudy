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
                        <h4 class="card-title">Data Alumni</h4>
                        <div class="table-responsive">
                            <table id="kt_table_alumni" class="table table-striped table-bordered dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NISN</th>
                                        <th>Lulusan</th>
                                        <th>Jurusan</th>
                                        <th>JK</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th>Email</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data will be populated by DataTables --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container-fluid -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#kt_table_alumni').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('alumni-humas') }}",
                    type: 'GET'
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // Menomori setiap baris
                        }
                    },
                    {
                        data: 'nama_alumni',
                        name: 'nama_alumni'
                    },
                    {
                        data: 'nisn',
                        name: 'nisn'
                    },
                    {
                        data: 'nama_jurusan',
                        name: 'nama_jurusan'
                    },
                    {
                        data: 'tahun_lulus',
                        name: 'tahun_lulus'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'alamat_alumni',
                        name: 'alamat_alumni'
                    },
                    {
                        data: 'no_hp_alumni',
                        name: 'no_hp_alumni'
                    },
                    {
                        data: 'email_alumni',
                        name: 'email_alumni'
                    },
                    {
                        data: 'foto_alumni',
                        name: 'foto_alumni',
                        render: function(data) {
                            return '<img src="{{ asset('uploads/alumni/') }}/' + data +
                                '" alt="foto" width="60"/>';
                        }
                    }
                ]
            });
        });
    </script>
@endsection
