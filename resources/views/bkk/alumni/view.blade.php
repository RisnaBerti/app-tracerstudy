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
                        <a href="{{ route('alumni-create') }}" class="btn btn-primary mb-2">
                            <i class="mdi mdi-plus mr-2"></i> Tambah Data
                        </a>

                        <table id="basic-datatable kt_table_alumni" class="table dt-responsive nowrap">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alumni as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama_alumni }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                                        <td>{{ $item->tahun_lulus->tahun_lulus ?? '-' }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->alamat_alumni }}</td>
                                        <td>{{ $item->no_hp_alumni }}</td>
                                        <td>{{ $item->email_alumni }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/alumni/' . $item->foto_alumni) }}" alt="foto"
                                                width="60">
                                        </td>
                                        <td>
                                            <a href="{{ route('alumni-edit', $item->nisn) }}" class="btn btn-warning">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="{{ route('alumni-delete', $item->nisn) }}" id="deleteButton"
                                                class="btn btn-danger delete-button">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#kt_table_alumni').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('alumni-bkk') }}",
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
                        render: function(data, type, full, meta) {
                            return '<img src="{{ asset('uploads/alumni/') }}/' + data +
                                '" alt="foto" width="60"/>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Delegasi acara untuk semua tombol dengan kelas delete-button
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah tindakan default dari tautan

                    const url = this.href; // Simpan URL dari tautan

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak akan dapat mengembalikan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Terhapus!',
                                'Data Anda telah dihapus.',
                                'success'
                            ).then(() => {
                                // Arahkan ke URL penghapusan setelah konfirmasi sukses
                                window.location.href = url;
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
