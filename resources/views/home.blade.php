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
                <img src="img/smk17.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Web App Absensi
              </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
              <a class="nav-link"><form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light">Logout</button>
            </form></a>
            </div>
          </div>
        </div>
      </nav>
    {{-- navbar end --}}

    {{-- halaman home --}}
    <div class="mt-2 text-center fw-bold">
        <h1>Selamat Datang<br><u>{{ Auth::user()->name }}</u><br>Web App Absensi</h1><hr>
    </div>
    <div class="mt-4">
        <h5>Langkah - Langkah Cara Pengguaan App</h5>
    </div>
    <div class="accordion mt-3" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            #1 Memasukkan data
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the first item’s accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            #2 Membuat Jadwal
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the second item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              #3 Aplikasi Siap
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the third item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              #4 Download data
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the third item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              #5 Membuat laporan
            </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the third item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="text-center py-3 border-top border-secondary small fw-light shadow-sm">
        &copy; 2025 CREATED BY CHARLES AGUSTIAN PUTRA
      </div>
      
    {{-- halaman home end --}}
    
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>