<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Data Jadwal Guru</title>
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
    <h2>Ubah Data Jadwal Guru</h2>
    <form action="{{ route('jadwalguru.update',$jadwaledit->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="no_jadwalguru" class="form-label">Kode Jadwal</label>
        <input type="text" id="no_jadwalguru" name="no_jadwalguru" class="form-control" value="{{ $jadwaledit->no_jadwalguru }}">
        <label for="hari" class="form-label">Hari</label>
        <input type="text" id="hari" name="hari" class="form-control" value="{{ $jadwaledit->hari }}">
        <label for="masuk" class="form-label">Jam Masuk</label>
        <input type="text" id="masuk" name="masuk" class="form-control" placeholder="CONTOH : PUKUL 06.30" value="{{ $jadwaledit->masuk }}">
        <label for="pulang" class="form-label">Jam Pulang</label>
        <input type="text" id="pulang" name="pulang" class="form-control" placeholder="CONTOH : PUKUL 12.30" value="{{ $jadwaledit->pulang }}">
        <label for="keterlambatan" class="form-label">Keterlambatan</label>
        <input type="text" id="keterlambatan" name="keterlambatan" class="form-control" placeholder="CONTOH : 120MENIT" value="{{ $jadwaledit->keterlambatan }}">
        {{-- <label for="keterangan" class="form-label">keterangan</label>
        <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ $jadwaledit->keterangan }}"> --}}
        {{-- select --}}
        <label for="id_jurusan" class="form-label">Jurusan</label>
        <select id="id_jurusan" name="id_jurusan" class="form-select">
            <option selected value="{{ $jadwaledit->id_jurusan }}">{{ $jadwaledit->jurusan->jurusan }}</option>
           @foreach ($jurusans as $jurusan)
               <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
           @endforeach
        </select>
        </div>
        {{-- select end --}}
        {{-- textarea --}}
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea id="keterangan" name="keterangan" class="form-control">{{ $jadwaledit->keterangan }}</textarea>
        {{-- textarea end --}}
        <a href="{{ route('jadwalguru.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        <button type="submit" class="btn btn-warning btn-sm">Ubah Data</button>
    </form>
    {{-- halaman home end --}}

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
