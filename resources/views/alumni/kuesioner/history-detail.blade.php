@extends('layouts.index-alumni')
@section('content')
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary">{{ $kuesioner->deskripsi_kuesioner }}</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h4 class="text-dark font-italic text-underline">{{ $kuesioner->judul_kuesioner }}</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered text-dark text-center">
                            <tr>
                                <th>Tanggal Kuesioner</th>
                                <th>Periode</th>
                            </tr>
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($kuesioner->tgl_kuesioner)->translatedFormat('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($kuesioner->awal)->translatedFormat('d F Y') . ' - ' . \Carbon\Carbon::parse($kuesioner->akhir)->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @if (Auth::user()->id_role == 4)
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered text-dark text-center">
                                <tr>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Status</th>
                                </tr>
                                <tr>
                                    <td>{{ $alumni->nama_alumni }}</td>
                                    <td>{{ $alumni->jurusan->nama_jurusan }}</td>
                                    <td><span class="badge badge-success">{{ $alumni->tahun_lulus->tahun_lulus }}</span>
                                    </td>
                                    <td><span class="badge badge-success">{{ $alumni->kategori->nama_kategori }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="tab-content" id="question-section">
                    @foreach ($kuesioner->pertanyaan as $pertanyaan)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-dark">{{ $pertanyaan->pertanyaan }}</h6>
                            </div>
                            <div class="card-body">
                                @foreach ($pertanyaan->jawaban as $jawaban)
                                    <p class="text-dark">{{ $jawaban->jawaban }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
