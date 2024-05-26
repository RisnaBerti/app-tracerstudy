<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
</head>

<body>

    <center>
        <h2>LAPORAN ALUMNI TAHUN {{ $tahun }}</h2>
        <h4>SMK </h4>
    </center>

    <br />

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alumni</th>
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
                <td colspan="3">Total</td>
                <td>{{ $totalAlumni }}</td>
            </tr>
        </tbody>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>
