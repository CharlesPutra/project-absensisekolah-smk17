 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Home</title>
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
     <div class="container ">
         <h3>Detail Absensi: {{ $guru->nama_guru }}</h3>
         @if ($guru->karyawan === 'Guru')
             <p>Jurusan: {{ $guru->jurusan->jurusan ?? '-' }}</p>
         @endif
         <p>Bulan: {{ $bulan }} / Tahun: {{ $tahun }}</p>
         <a href="{{ route('laporan') }}" class="btn btn-secondary btn-sm">Kembali</a>
         <a href="{{ route('absensi.export.pdf', ['id' => $guru->id, 'tahun' => $tahun, 'bulan' => $bulan]) }}"
             class="btn btn-danger btn-sm" target="_blank">
             Export PDF
         </a>
         <a href="{{ route('absensi.print', ['id' => $guru->id, 'tahun' => $tahun, 'bulan' => $bulan]) }}"
             class="btn btn-primary btn-sm" target="_blank">
              Print
         </a>
         {{-- <a href="{{ route('absensi.print', ['id' => $guru->id, 'tahun' => $tahun, 'bulan' => $bulan]) }}"
             class="btn btn-secondary" target="_blank">
             🖨 Print
         </a> --}}
         <table class="table table-bordered">
             <thead>
                 <tr class="text-center">
                     <th>Tanggal</th>
                     <th>Hari</th>
                     <th>Status</th>
                     <th>Jam Masuk</th>
                     <th>Jam Pulang</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($absensiPerHari as $hari)
                     <tr>
                         <td>{{ $hari['tanggal'] }}</td>
                         <td>{{ $hari['hari'] }}</td>
                         <td>{{ $hari['status'] }}</td>
                         <td>{{ $hari['jam_masuk'] ?? '-' }}</td>
                         <td>{{ $hari['jam_pulang'] ?? '-' }}</td>
                     </tr>
                 @endforeach
             </tbody>

         </table>
     </div>

     <hr>
     <div class="text-center py-3 border-top border-secondary small fw-light shadow-sm">
         &copy; 2025 CREATED BY CHARLES AGUSTIAN PUTRA
     </div>

     {{-- halaman home end --}}

     <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
 </body>

 </html>
