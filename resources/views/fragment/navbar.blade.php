<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home - Web Absensi</title>
    <link rel="icon" href="img/smk17.png" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .nav-link button {
            border-radius: 8px;
        }

        h1 {
            font-size: 2rem;
        }

        .accordion-button {
            font-weight: 600;
        }

        .footer {
            background-color: #f1f1f1;
            font-size: 0.85rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <img src="img/smk17.png" alt="Logo" width="30" height="30" class="me-2" />
                Web App Absensi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto gap-3 fw-semibold">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                    <a class="nav-link" href="{{ route('guru.index') }}">Karyawan / Guru</a>
                    <a class="nav-link" href="{{ route('ijin.index') }}">Ijin / Cuti / Sakit</a>

                    <!-- Dropdown -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownJadwal" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Pengaturan Jadwal
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownJadwal">
                            <li><a class="dropdown-item" href="{{ route('jadwalkaryawan.index') }}">Jadwal Karyawan</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('jadwalguru.index') }}">Jadwal Guru</a></li>
                        </ul>
                    </div>

                    <a class="nav-link" href="{{ route('jurusan.index') }}">Jurusan</a>
                    <a class="nav-link" href="{{ route('laporan') }}">Laporan</a>

                    <!-- Logout form styled as a link -->
                    <div class="nav-item d-flex align-items-center">
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit"
                                class="nav-link btn btn-link text-danger text-decoration-none p-0">Logout</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </nav>


    <!-- Home Content -->
   <main>
    @yield('navbar')
   </main>
    <!-- Footer -->
    <div class="footer text-center py-3 border-top">
        &copy; 2025 CREATED BY CHARLES AGUSTIAN PUTRA
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
