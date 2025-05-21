<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h3>Laporan Absensi - {{ $guru->nama_guru }}</h3>
    @if ($guru->karyawan === 'Guru')
        <p>Jurusan: {{ $guru->jurusan->jurusan ?? '-' }}</p>
    @endif
    <p>Bulan: {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->translatedFormat('F') }} {{ $tahun }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Hari</th>
                <th>Status</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensiPerHari as $index => $absen)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $absen['tanggal'] }}</td>
                    <td>{{ $absen['hari'] }}</td>
                    <td>{{ $absen['status'] }}</td>
                    <td>{{ $absen['jam_masuk'] ?? '-' }}</td>
                    <td>{{ $absen['jam_pulang'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
