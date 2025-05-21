<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Ijin</title>
    <link rel="icon" href="{{ asset('img/smk17.png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    {{-- navbar --}}
    <nav class="navbar  sticky-top  navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('img/smk17.png') }}" alt="Logo" width="30" height="30"
                    class="d-inline-block align-text-top">
                Web App Absensi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto gap-2">
                    {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
                    {{-- <a class="nav-link" href="#">Features</a> --}}
                    <a class="nav-link" href="{{ route('home') }}"><button class="btn btn-light">Home</button></a>
                    <a class="nav-link" href="{{ route('guru.index') }}"><button class="btn btn-light">Karyawan / Guru</button></a>
                    <a class="nav-link" href="{{ route('ijin.index') }}"><button class="btn btn-light">Ijin / Cuti / Sakit</button></a>
                    {{-- dropdown --}}
                    <div class="dropdown mt-2">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Pengaturan Jadwal
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('jadwalkaryawan.index') }}">Jadwal Karyawan</a></li>
                            <li><a class="dropdown-item" href="{{ route('jadwalguru.index') }}">Jadwal Guru</a></li>
                        </ul>
                    </div>
                    {{-- dropdown end --}}
                    {{-- dropdown --}}
                                              <a class="nav-link" href="{{ route('jurusan.index') }}"><button class="btn btn-light">Jurusan</button></a>

                    {{-- dropdown end --}}
                    {{-- dropdown --}}
                                     <a class="nav-link" href="{{ route('laporan') }}"><button class="btn btn-light">Laporan</button></a>

                    {{-- dropdown end --}}
                    <a class="nav-link">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light">Logout</button>
                        </form>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    {{-- navbar end --}}

    {{-- halaman home --}}
    <h2>Tambah Data Ijin/Cuti Atau Sakit</h2>
    <form action="{{ route('ijin.store') }}" method="POST">
        @csrf
         <label for="id_nama" class="form-label">Nama Guru/Karyawan</label>
            <select id="id_nama" name="id_nama" class="form-select">
                <option selected>Semua Guru Dan Karyawan</option>
               @foreach ($gurus as $guru)
                   <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
               @endforeach
            </select>
        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
        <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control">
        <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
        <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" class="form-control">
         <label for="keterangan" class="form-label">Keterangan</label>
            <select id="keterangan" name="keterangan" class="form-select">
                <option selected>Keterangan Ijin</option>
                <option value="IJIN/CUTI">IJIN/CUTI</option>
                <option value="SAKIT">SAKIT</option>
            </select>
        <a href="{{ route('ijin.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        <button type="submit" class="btn btn-primary btn-sm">Tambah Data</button>
    </form>
    {{-- halaman home end --}}

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
