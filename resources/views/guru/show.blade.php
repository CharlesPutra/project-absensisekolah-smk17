<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Data Karyawan/Guru</title>
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
                    <a class="nav-link" href="{{ route('guru.index') }}"><button class="btn btn-light">Karyawan /
                            Guru</button></a>
                    <a class="nav-link" href="{{ route('ijin.index') }}"><button class="btn btn-light">Ijin / Cuti / Sakit</button></a>
                    {{-- dropdown --}}
                    <div class="dropdown mt-2">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Pengaturan Jadwal
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('jadwalkaryawan.index') }}">Jadwal Karyawan</a>
                            </li>
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
    <h2>Tambah Data Karyawan/Guru</h2>
    <form action="{{ route('guru.update', $show->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="no_guru" class="form-label">Id Karyawan/Guru</label>
        <input type="int" id="no_guru" name="no_guru" class="form-control" value="{{ $show->no_guru }}" disabled>
        <label for="nama_guru" class="form-label">Nama Karyawan/Guru</label>
        <input type="text" id="nama_guru" name="nama_guru" class="form-control" value="{{ $show->nama_guru }}" disabled>

        {{-- select jenis kelamin  --}}
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" disabled>
            <option selected value="{{ $show->jenis_kelamin }}">{{ $show->jenis_kelamin }}</option>
            <option value="Laki_Laki">Laki-Laki</option>
            <option value="Permpuan">Perempuan</option>
        </select>
        {{-- select jenis kelamin end --}}

        {{-- Select Role --}}
        <label for="karyawan" class="form-label">Pilih Role:</label>
        <select id="karyawan" name="karyawan" class="form-select" required>
            <option selected value="{{ $show->karyawan }}">{{ $show->karyawan }}</option>
            <option value="Karyawan">Karyawan</option>
            <option value="Guru">Guru</option>
        </select>
        <div id="passwordHelpBlock" class="form-text">
            saran ketika role yang muncul guru tolong click role guru yang paling bawah lagi ketika mau melihat jadwal guru dan jurusan guru 
        </div>
        {{-- Select Role End --}}

        {{-- Select Jadwal Karyawan --}}
        <div id="karyawanFields">
            <label for="id_jadwalkaryawan" class="form-label">Jadwal Karyawan</label>
            <select id="id_jadwalkaryawan" name="id_jadwalkaryawan" class="form-select" disabled>
                <option selected value="{{ $show->id_jadwalkaryawan }}">{{ optional($show->jadwalkr)->no_jadwal }}</option>
                @foreach ($jadwalkr as $karyawan)
                    <option value="{{ $karyawan->id }}">{{ $karyawan->no_jadwal }}</option>
                @endforeach
            </select>
        </div>
        {{-- Select Jadwal Karyawan End --}}

        {{-- Select Role Guru --}}
        <div class="additional-fields" id="guruFields" style="display: none;">
            {{-- Jurusan --}}
            <label for="id_jurusan" class="form-label">Jurusan</label>
            <select id="id_jurusan" name="id_jurusan" class="form-select" disabled>
                <option selected value="{{ $show->id_jurusan }}">{{ optional($show->jurusan)->no_jurusan }}</option>
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
                @endforeach
            </select>
            {{-- Jadwal --}}
            <label for="id_jadwalguru" class="form-label">Jadwal Guru</label>
            <select id="id_jadwalguru" name="id_jadwalguru" class="form-select" disabled>
                <option selected value="{{ $show->id_jadwalguru }}">{{ optional($show->jadwalgr)->no_jadwalguru}}</option>
                @foreach ($jadwalguru as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->no_jadwalguru }}</option>
                @endforeach
            </select>
        </div>
        {{-- Select Role Guru End --}}

        <a href="{{ route('guru.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        {{-- <button type="submit" class="btn btn-primary btn-sm">Tambah Data</button> --}}
    </form>
    {{-- halaman home end --}}

    <script>
        const roleSelect = document.getElementById('karyawan');
        const guruFields = document.getElementById('guruFields');
        const karyawanFields = document.getElementById('karyawanFields');

        roleSelect.addEventListener('change', () => {
            if (roleSelect.value === 'Guru') {
                guruFields.style.display = 'block'; // Show Guru fields
                karyawanFields.style.display = 'none'; // Hide Karyawan fields
                document.getElementById('id_jadwalkaryawan').value = '';
            } else if (roleSelect.value === 'Karyawan') {
                guruFields.style.display = 'none'; // Hide Guru fields
                karyawanFields.style.display = 'block'; // Show Karyawan fields
                // Clear guru fields values so they don't submit data accidentally
                document.getElementById('id_jurusan').value = '';
                document.getElementById('id_jadwalguru').value = '';
            }
        });
    </script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
