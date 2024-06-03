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
                        <h4 class="card-title">{{ $title }}</h4>

                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('opsi-create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus mr-2"></i> Tambah Data
                            </a>
                        </div>

                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pertanyaan</th>
                                    <th>Opsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opsi as $index => $items)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $items->pertanyaan->pertanyaan }}</td>
                                        <td>{{ $items->opsi }}</td>
                                        <td>
                                            <a href="{{ route('opsi-edit', $items->id_opsi) }}" class="btn btn-warning">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('opsi-delete', $items->id_opsi) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete-button"
                                                    id="deletebutton">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                            {{-- <a href="{{ route('opsi-delete', $items->id_opsi) }}" id="deletebutton" class="btn btn-danger delete-button">
                                                <i class="mdi mdi-delete"></i>
                                            </a> --}}
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
