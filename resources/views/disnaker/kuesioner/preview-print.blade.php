<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kuesioner Alumni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2, h4 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .tanda-tangan {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .tanda-tangan div {
            text-align: center;
            width: 45%; /* Lebar 45% untuk setiap tanda tangan */
        }
    </style>
</head>

<body>

    <center>
        <h2>LAPORAN KEUSIONER ALUMNI</h2>
        <h4>SMA YPE KROYA</h4>
    </center>

    <br />

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $title }}</h4>
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

            <div class="tanda-tangan">
                <div>
                    <p>Diketahui,</p>
                    <p>Kepala Sekolah</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>(...........................)</p>  
                </div>
                <div>
                    <p>Diketahui,</p>
                    <p>Waka Disnaker</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>(...........................)</p>  
                </div>
            </div>

        </div> <!-- end card body-->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</body>

</html>
