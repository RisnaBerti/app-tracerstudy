<!DOCTYPE html>
<html>

<head>
    <title>Laporan Alumni</title>
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
    </style>
</head>

<body>

    <center>
        <h2>LAPORAN ALUMNI TAHUN {{ $tahun }}</h2>
        <h4>SMK [Nama Sekolah]</h4>
    </center>

    <br />

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Jurusan</th>
                <th>Tahun Lulus</th>
                <th>Jumlah Alumni</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAlumni = 0;
            @endphp
            @foreach ($alumniPerJurusanPerTahun as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_jurusan }}</td>
                    <td>{{ $item->tahun_lulus }}</td>
                    <td>{{ $item->jumlah_alumni }}</td>
                </tr>
                @php
                    $totalAlumni += $item->jumlah_alumni;
                @endphp
            @endforeach
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>{{ $totalAlumni }}</strong></td>
            </tr>
        </tbody>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>
