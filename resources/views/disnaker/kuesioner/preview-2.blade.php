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
                        <a href="{{ route('hasil-preview2-disnaker', ['id' => $id]) }}" class="nav-link active">Grafik Alumni</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview3-disnaker', ['id' => $id]) }}" class="nav-link">Bekerja</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview4-disnaker', ['id' => $id]) }}" class="nav-link">Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview5-disnaker', ['id' => $id]) }}" class="nav-link">Wirausaha</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-preview6-disnaker', ['id' => $id]) }}" class="nav-link">Belum Bekerja</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title
                        ">Grafik Alumni</h4>
                        {{-- <p class="card-title-desc">Grafik Alumni</p> --}}

                        {{-- grafik alumni per tahun per jurusan --}}
                        <div id="grafik-alumni">
                            <div id="responsive-chart"></div>
                        </div>


                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jurusan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Jumlah Alumni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($data as $tahun_lulus => $jurusan_data)
                                    @foreach ($jurusan_data as $nama_jurusan => $jumlah_alumni)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $tahun_lulus }}</td>
                                            <td>{{ $nama_jurusan }}</td>
                                            <td>{{ $jumlah_alumni }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div>
        </div>
        <!-- end row-->

    </div> <!-- container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'bar'
            },
            series: {!! json_encode($seriesData) !!},
            xaxis: {
                categories: {!! json_encode($categories) !!}
            },
            responsive: [{
                breakpoint: 1000,
                options: {
                    chart: {
                        width: '100%'
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#responsive-chart"), options);

        chart.render();
    </script>
@endsection
