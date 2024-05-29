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
            {{-- Tombol nav-tabs hasil 1, hasil 2, hasil 3, hasil 4, hasil 5 --}}
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview-humas', ['id' => $id]) }}" class="nav-link active">Grafik
                            Pengisian</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview2', ['id' => $id]) }}" class="nav-link">Grafik Alumni</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview3', ['id' => $id]) }}" class="nav-link">Bekerja</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview4', ['id' => $id]) }}" class="nav-link">Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview5', ['id' => $id]) }}" class="nav-link">Wirausaha</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview6', ['id' => $id]) }}" class="nav-link">Belum Bekerja</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- tombol print nav Grafik Pengisian --}}
                        <div class="d-print-none mb-2">
                            <div class="text-end">
                                <button class="btn btn-primary" onclick="window.print()"><i
                                        class="uil uil-print me-2"></i>Print</button>
                            </div>
                        </div>
                        <h4 class="card-title">{{ $title }}</h4>
                        {{-- <p class="card-title-desc">Grafik Pengisian</p> --}}
                        @foreach ($data as $kategori => $pertanyaan)
                            <h2>{{ $kategori }}</h2>
                            @foreach ($pertanyaan as $question => $details)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $question }}</h4>
                                        @if ($details['tipe'] === 'Pilihan')
                                            <p class="card-title-desc">Grafik jawaban untuk pertanyaan:
                                                "{{ $question }}"
                                            </p>
                                            <div id="grafik-{{ Str::slug($question) }}"></div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var options = {
                                                        series: @json($details['jumlah_jawaban']), // Banyak jawaban per pilihannya
                                                        chart: {
                                                            width: 380,
                                                            type: 'pie',
                                                        },
                                                        labels: @json($details['jawaban']), // Data jawaban setiap pertanyaan pilihan
                                                        responsive: [{
                                                            breakpoint: 480,
                                                            options: {
                                                                chart: {
                                                                    width: 200
                                                                },
                                                                legend: {
                                                                    position: 'bottom'
                                                                }
                                                            }
                                                        }]
                                                    };

                                                    var chart = new ApexCharts(document.querySelector("#grafik-{{ Str::slug($question) }}"), options);
                                                    chart.render();
                                                });
                                            </script>
                                        @else
                                            <p class="card-title-desc">Jawaban untuk pertanyaan: "{{ $question }}"</p>
                                            <ul>
                                                @foreach ($details['jawaban'] as $jawaban)
                                                    <li>{{ $jawaban }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endforeach

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div>
        </div>
        <!-- end row-->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        {{-- <script>
            @foreach ($preview1 as $index => $data)
                var options = {
                    series: [{{ $data->jumlah_jawaban }}], // banyak jawaban per pilihannya
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: [{{ $data->jawaban }}], // ganti dengan data jawaban setiap pertanyaan pilihan
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#responsive-chart-{{ $index }}"), options);
                chart.render();
            @endforeach
        </script> --}}
    @endsection
