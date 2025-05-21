<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Karyawan</title>
    <link rel="icon" href="img/smk17.png">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    {{-- navbar --}}
    <nav class="navbar  sticky-top  navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <img src="img/smk17.png" alt="Logo" width="30" height="30"
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
    <div class="container mt-5">
        <h1>Jadwal Karyawan</h1>
        <a href="{{ route('jadwalkaryawan.create') }}" class="btn btn-primary">Tambah Data Jadwal guru</a>
          <!-- Search Form -->
    <form method="GET" action="{{ route('jadwalkaryawan.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Jurusan..." value="{{ request('search') }}" />
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Jadwal</th>
                    <th>Hari</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $karyawan)
                    <tr>
                        <td>{{ $karyawan->no_jadwal}}</td>
                        <td>{{ $karyawan->hari }}</td>
                        <td>{{ $karyawan->masuk }}</td>
                        <td>{{ $karyawan->pulang }}</td>
                        <td class="">
                          <a href="{{ route('jadwalkaryawan.show',$karyawan->id) }}" class="btn btn-secondary btn-sm">Lihat</a>
                          <a href="{{ route('jadwalkaryawan.edit',$karyawan->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                          <form action="{{ route('jadwalkaryawan.destroy',$karyawan->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                          </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- pagination --}}
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="{{ $karyawans->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $karyawans->lastPage(); $i++)
                    <li class="page-item {{ $karyawans->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $karyawans->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $karyawans->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

         {{-- {{ $jadwalgurus->appends(['search' => request('search')])}} --}}
        {{-- pagination end --}}
    </div>
    <hr>
    <div class="text-center py-3 border-top border-secondary small fw-light shadow-sm">
        &copy; 2025 CREATED BY CHARLES AGUSTIAN PUTRA
    </div>

    {{-- halaman home end --}}

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
