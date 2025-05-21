 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Home</title>
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
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                 data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                 aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                 <div class="navbar-nav ms-auto gap-2">
                     {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
                     {{-- <a class="nav-link" href="#">Features</a> --}}
                     <a class="nav-link" href="{{ route('home') }}"><button class="btn btn-light">Home</button></a>
                     <a class="nav-link" href="{{ route('guru.index') }}"><button class="btn btn-light">Karyawan /
                             Guru</button></a>
                     <a class="nav-link" href="{{ route('ijin.index') }}"><button class="btn btn-light">Ijin / Cuti /
                             Sakit</button></a>
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
                     <a class="nav-link" href="{{ route('jurusan.index') }}"><button
                             class="btn btn-light">Jurusan</button></a>

                     {{-- dropdown end --}}

                     {{-- dropdown --}}
                     <a class="nav-link" href="{{ route('laporan') }}"><button
                             class="btn btn-light">Laporan</button></a>
                     {{-- <div class="dropdown mt-2">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Laporan
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Karyawan</a></li>
                  <li><a class="dropdown-item" href="{{ route() }}">Guru</a></li>
                </ul>
              </div> --}}
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
     <div class="container">
         <h2>Hasil Laporan Absensi</h2>

         <a href="{{ route('laporan') }}" class="btn btn-secondary mb-3 btn-sm">Kembali ke Filter</a>
         <a href="{{ route('absensi.semua.export.pdf', ['tahun' => $tahun, 'bulan' => $bulan]) }}"
             class="btn btn-danger mb-3 btn-sm" target="_blank">Export PDF Semua Guru/Karyawan
         </a>
         <a href="{{ route('absensi.semua.print', ['tahun' => $tahun, 'bulan' => $bulan]) }}" class="btn btn-primary mb-3 btn-sm"
             target="_blank">
              Print Semua Guru/Karyawan
         </a>


         @if ($tahun && $bulan)
             <div class="alert alert-info">
                 Menampilkan data untuk <strong>Bulan: {{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}</strong> Tahun
                 <strong>{{ $tahun }}</strong>
             </div>
         @elseif ($tahun)
             <div class="alert alert-info">
                 Menampilkan data untuk <strong>Tahun: {{ $tahun }}</strong>
             </div>
         @endif

         @if ($absensi->isEmpty())
             <div class="alert alert-warning">Tidak ada data ditemukan untuk filter ini.</div>
         @else
             <table class="table table-bordered">
                 <thead>
                     <tr class="text-center">
                         <th>Id</th>
                         <th>Nama Guru</th>
                         <th>Kelamin</th>
                         <th>Kehadiran</th>
                         <th>Telat</th>
                         <th>Ijin/Cuti/Sakit</th>
                         <th>Tidak Hadir</th>
                         <th>Detail</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse ($absensi as $data)
                         <tr class="text-center">
                             <td>{{ $data->no_guru }}</td>
                             <td>{{ $data->nama_guru }}</td>
                             <td>{{ $data->jenis_kelamin }}</td>
                             <td>{{ $data->total_absen }}</td>
                             <td>{{ $data->total_telat }}</td>
                             <td>{{ $data->total_ijin }}</td>
                             <td>{{ $data->total_tidak_hadir }}</td>
                             <td>
                                 <a href="{{ route('laporan.absensi_detail', [
                                     'id' => $data->id_anggota,
                                     'tahun' => $tahun,
                                     'bulan' => $bulan,
                                 ]) }}"
                                     class="btn btn-sm btn-primary">
                                     Lihat Detail
                                 </a>
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="4">Tidak ada data absensi.</td>
                         </tr>
                     @endforelse
                 </tbody>
             </table>
         @endif
     </div>
     <hr>
     <div class="text-center py-3 border-top border-secondary small fw-light shadow-sm">
         &copy; 2025 CREATED BY CHARLES AGUSTIAN PUTRA
     </div>

     {{-- halaman home end --}}

     <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
 </body>

 </html>
