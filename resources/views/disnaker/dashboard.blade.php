@extends('layouts.index-disnaker')
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

        <div class="row">
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
                                {{-- <span class="text-muted">12.5% <i class="mdi mdi-arrow-up text-success"></i></span> --}}
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
                                {{-- <span class="text-muted">18.71% <i class="mdi mdi-arrow-down text-danger"></i></span> --}}
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
                                {{-- <span class="text-muted">57% <i class="mdi mdi-arrow-up text-success"></i></span> --}}
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
                                {{-- <span class="text-muted">17.8% <i class="mdi mdi-arrow-down text-danger"></i></span> --}}
                            </div>
                        </div>

                        <div class="progress shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 57%;"></div>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title d-inline-block">Grafik Total Alumni Per Tahun</h4>
                        <div id="grafik-alumni">
                            <div id="responsive-chart"></div>
                        </div>

                        {{-- <div id="morris-line-example" class="morris-chart" style="height: 290px;"></div> --}}

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
            {{-- <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Aktivitas</h4>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Create Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-user">
                                            <img src="assets/images/users/avatar-4.jpg" alt="table-user"
                                                class="mr-2 avatar-xs rounded-circle">
                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Paul J.
                                                Friend</a>
                                        </td>
                                        <td>
                                            937-330-1634
                                        </td>
                                        <td>
                                            pauljfrnd@jourrapide.com
                                        </td>
                                        <td>
                                            New York
                                        </td>
                                        <td>
                                            07/07/2018
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="table-user">
                                            <img src="assets/images/users/avatar-3.jpg" alt="table-user"
                                                class="mr-2 avatar-xs rounded-circle">
                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Bryan J.
                                                Luellen</a>
                                        </td>
                                        <td>
                                            215-302-3376
                                        </td>
                                        <td>
                                            bryuellen@dayrep.com
                                        </td>
                                        <td>
                                            New York
                                        </td>
                                        <td>
                                            09/12/2018
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-user">
                                            <img src="assets/images/users/avatar-8.jpg" alt="table-user"
                                                class="mr-2 avatar-xs rounded-circle">
                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Kathryn
                                                S. Collier</a>
                                        </td>
                                        <td>
                                            828-216-2190
                                        </td>
                                        <td>
                                            collier@jourrapide.com
                                        </td>
                                        <td>
                                            Canada
                                        </td>
                                        <td>
                                            06/30/2018
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-user">
                                            <img src="assets/images/users/avatar-1.jpg" alt="table-user"
                                                class="mr-2 avatar-xs rounded-circle">
                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Timothy
                                                Kauper</a>
                                        </td>
                                        <td>
                                            (216) 75 612 706
                                        </td>
                                        <td>
                                            thykauper@rhyta.com
                                        </td>
                                        <td>
                                            Denmark
                                        </td>
                                        <td>
                                            09/08/2018
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-user">
                                            <img src="assets/images/users/avatar-5.jpg" alt="table-user"
                                                class="mr-2 avatar-xs rounded-circle">
                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">Zara
                                                Raws</a>
                                        </td>
                                        <td>
                                            (02) 75 150 655
                                        </td>
                                        <td>
                                            austin@dayrep.com
                                        </td>
                                        <td>
                                            Germany
                                        </td>
                                        <td>
                                            07/15/2018
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!--end card body-->

                </div>
                <!--end card-->
            </div> --}}
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
