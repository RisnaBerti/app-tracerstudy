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
            {{-- Tombol nav-tabs hasil 1, hasil 2, hasil 3, hasil 4, hasil 5 --}}
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" class="nav-link active">Grafik Pengisian</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Hasil 2</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Hasil 3</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Hasil 4</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Hasil 5</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- tombol print nav Grafik Pengisian --}}
                        <div class="d-print-none mb-2">
                            <div class="text-end">
                                <button class="btn btn-primary" onclick="window.print()"><i class="uil uil-print me-2"></i>Print</button>
                            </div>
                        </div>
                        <h4 class="card-title">{{ $title }}</h4>
                        <p class="card-title-desc">Grafik Pengisian</p>
                        @foreach($preview1 as $index => $data)
                        <table class="table table-bordered text-dark text-end">
                            <tr>
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-dark">
                                            {{ $data->pertanyaan }}
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        {{-- grafik menampilkan data loop sesuai jawaban --}}
                                        <div id="grafik-preview-{{ $index }}">
                                            <div id="responsive-chart-{{ $index }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        </table>
                        @endforeach
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div>
        </div>
        <!-- end row-->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
        @foreach($preview1 as $index => $data)
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
        </script>
        
    @endsection
