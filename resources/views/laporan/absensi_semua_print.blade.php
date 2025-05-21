<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Print Laporan Absensi</title>
    <link rel="icon" href="{{ asset('img/smk17.png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        h3 {
            margin-bottom: 5px;
        }

        p {
            margin: 0;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="no-print" style="margin-bottom: 20px;">
        <a href="{{ route('laporan') }}" class="btn btn-secondary btn-sm">Kembali</a>
        <button onclick="window.print()" class="btn btn-primary btn-sm"> Cetak Laporan</button>
    </div>

    @foreach ($dataRekap as $guruData)
        <h3>Laporan Absensi - {{ $guruData['guru']->nama_guru }}</h3>
        @if ($guruData['guru']->karyawan === 'Guru')
            <p>Jurusan: {{ $guruData['guru']->jurusan->jurusan ?? '-' }}</p>
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
                @foreach ($guruData['absensiPerHari'] as $index => $absen)
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

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
