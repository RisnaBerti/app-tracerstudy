@extends('layouts.index-alumni')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tracer Study</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{-- tampilkan tulisan selamat datang (nama mahasiswa) di sistem TRACERSTUDY SMK YPE KROYA CILACAP card nya warna biru --}}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title
                        d-inline-block">Selamat Datang Dashboard Siswa, {{ Auth::user()->nama_alumni }}</h1>
                        <p class="card-text">di Sistem Tracer Study SMK YPE Kroya Cilacap</p>
                    </div>
                    <!--end card body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>


        {{-- tampilkan kuesioner terbaru berdasarkan rentang tahun kuesionernya --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title
                        d-inline-block">Kuesioner Terbaru</h4>

                        {{-- more info lalu link ke menu kuesioner-alumni --}}
                        {{-- card lalu ada tulisan TRACER STUDY lalu ada <p>Silahkan Cek Pengisian Kuesioner Terbaru</p> lalu di bawahnya ada tombol untuk link ke menu kuesioner cardnya warna biru--}}

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title
                                d-inline-block">TRACER STUDY</h4>
                                <p>Silahkan Cek Pengisian Kuesioner Terbaru</p>

                                {{-- Tombol untuk melanjutkan ke menu kuesioner-alumni DENGAN TOMBOL KLIK SELANJUTNYA DENGAN ICON PANAH LALU TOMBOL BERWARNA BIRU DI TENGAH MEMANJANG --}}
                                <a href="{{ route('kuesioner-alumni') }}" class="btn btn-primary btn-sm float-right">Klik untuk pengisian <i class="mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>




                        {{-- <a href="{{ route('kuesioner-alumni') }}" class="btn btn-primary btn-sm float-right">Lihat
                            Semua</a> --}}




                       
                    </div>
                    <!--end card body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->


        {{-- <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-primary float-right">Per {{ date('Y') }}</span>
                            <h5 class="card-title mb-0">Alumni Kuliah</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{ $alumni_kuliah }}
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                            </div>
                        </div>

                        <div class="progress shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 57%;">
                            </div>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-primary float-right">Per {{ date('Y') }}</span>
                            <h5 class="card-title mb-0">Alumni Bekerja</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{ $alumni_bekerja }}
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                            </div>
                        </div>

                        <div class="progress shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 57%;">
                            </div>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-primary float-right">Per {{ date('Y') }}</span>
                            <h5 class="card-title mb-0">Alumni Wirausaha</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{ $alumni_wirausaha }}
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                            </div>
                        </div>

                        <div class="progress shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 57%;">
                            </div>
                        </div>
                    </div>
                    <!--end card body-->
                </div>
                <!--end card-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-primary float-right">Per {{ date('Y') }}</span>
                            <h5 class="card-title mb-0">Alumni Belum Bekerja</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{ $alumni_belum_bekerja }}
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                            </div>
                        </div>

                        <div class="progress shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 57%;"></div>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->
        </div> --}}
        <!-- end row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title d-inline-block">Grafik Total Alumni Per Tahun</h4>
                        <div id="grafik-alumni">
                            <div id="responsive-chart"></div>
                        </div>

                        <div class="row text-center mt-4">
                            <div class="col-6">
                                <h4>{{ $alumni }}</h4>
                                <p class="text-muted mb-0">Total Alumni</p>
                            </div>
                            <div class="col-6">
                                <h4>{{ date('Y') }}</h4>
                                <p class="text-muted mb-0">Per Tahun Lulus</p>
                            </div>
                        </div>

                    </div>
                    <!--end card body-->

                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div> <!-- container-fluid -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'bar'
            },
            series: [{
                name: 'Total Alumni',
                data: @json(array_values($alumni_per_tahun->toArray())) // Mengambil total alumni per tahun
            }],
            xaxis: {
                categories: @json(array_keys($alumni_per_tahun->toArray())) // Mengambil tahun lulus
            },
            responsive: [{
                breakpoint: 1000,
                options: {
                    plotOptions: {
                        bar: {
                            horizontal: false
                        }
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }]
        }

        var chart = new ApexCharts(document.querySelector("#responsive-chart"), options);

        chart.render();
    </script>
@endsection
