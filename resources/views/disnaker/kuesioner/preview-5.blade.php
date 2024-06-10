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
            {{-- Tombol nav-tabs hasil 1, hasil 2, hasil 3, hasil 4, hasil 5 --}}
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview-disnaker', ['id' => $id]) }}" class="nav-link ">Grafik Pengisian</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview2-disnaker', ['id' => $id]) }}" class="nav-link ">Grafik Alumni</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview3-disnaker', ['id' => $id]) }}" class="nav-link">Bekerja</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview4-disnaker', ['id' => $id]) }}" class="nav-link">Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview5-disnaker', ['id' => $id]) }}" class="nav-link active">Wirausaha</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview6-disnaker', ['id' => $id]) }}" class="nav-link">Belum Bekerja</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Preview Wirausaha</h4>
                        {{-- <p class="card-title-desc">Preview Wirausaha</p> --}}
                        
                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Usaha</th>
                                    <th>Nama Usaha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $nama_alumni => $jawaban)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nama_alumni }}</td>
                                        <td>{{ $jawaban['Wirausaha bidang apa yang sedang anda jalankan saat ini?'] ?? 'N/A' }}</td>
                                        <td>{{ $jawaban['Apa nama usaha yang anda jalankan?'] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div>          
        </div>
        <!-- end row-->

    </div> <!-- container-fluid -->
@endsection
