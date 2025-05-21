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
         <h1 class="text-center">Laporan Absensi</h1>
         <form action="{{ route('laporan.filter') }}" method="GET">
            <div class="row mb-3">
            <div class="col-md-3">
                <label for="tahun" class="form-label">Tahun</label>
                <select name="tahun" id="tahun" class="form-select">
                    @for ($i = date('Y') - 2; $i <= date('Y') + 2; $i++)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <label for="bulan" class="form-label">Bulan</label>
                <select name="bulan" id="bulan" class="form-select">
                    @foreach (range(1, 12) as $b)
                        <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                            {{ str_pad($b, 2, '0', STR_PAD_LEFT) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="karyawan" class="form-label">Jabatan</label>
                <input type="text" name="karyawan" id="karyawan" class="form-control" value="{{ request('karyawan') }}" placeholder="contoh:Guru/Karyawan">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
         </form>

         <hr>
         <div class="text-center py-3 border-top border-secondary small fw-light shadow-sm">
             &copy; 2025 CREATED BY CHARLES AGUSTIAN PUTRA
         </div>

         {{-- halaman home end --}}
         {{-- <script>
             document.addEventListener('DOMContentLoaded', function() {
                 const filterForm = document.getElementById('filterForm');
                 filterForm.addEventListener('submit', function(event) {
                     event.preventDefault(); // Mencegah pengiriman form secara default
                     const tahun = document.getElementById('tahun').value;
                     const bulan = document.getElementById('bulan').value;
                     const karyawan = document.getElementById('karyawan').value;
                     // Mengambil data dari server
                     fetch(`/laporan?tahun=${tahun}&bulan=${bulan}&karyawan=${karyawan}`)
                         .then(response => response.json())
                         .then(data => {
                             const resultDiv = document.getElementById('result');
                             resultDiv.innerHTML = ''; // Kosongkan hasil sebelumnya
                             if (data.length > 0) {
                                 data.forEach(item => {
                                     const div = document.createElement('div');
                                     div.className = 'alert alert-info';
                                     div.textContent =
                                         `ID: ${item.id_absensi}, Anggota: ${item.id_anggota}, Waktu Absen: ${item.waktu_absen}`;
                                     resultDiv.appendChild(div);
                                 });
                             } else {
                                 resultDiv.innerHTML =
                                     '<div class="alert alert-warning">Tidak ada data untuk ditampilkan.</div>';
                             }
                         })
                         .catch(error => {
                             console.error('Error:', error);
                             const resultDiv = document.getElementById('result');
                             resultDiv.innerHTML =
                                 '<div class="alert alert-danger">Terjadi kesalahan saat mengambil data.</div>';
                         });
                 });
             });
         </script> --}}
         <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
 </body>

 </html>
