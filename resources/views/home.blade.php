@extends('fragment.navbar')

@section('navbar')
     <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Selamat Datang,<br><u>{{ Auth::user()->name }}</u></h1>
            <p class="lead mt-2">di Web App Absensi</p>
            <hr />
        </div>

        <div class="text-center mb-4">
            <h5 class="fw-semibold">Langkah-Langkah Penggunaan Aplikasi</h5>
        </div>

        <div class="accordion" id="accordionExample">
            @php
                $steps = [
                    [
                        'title' => '#1 Memasukkan data',
                        'body' => 'Masukkan data guru, karyawan, siswa atau entitas lain yang dibutuhkan.',
                    ],
                    [
                        'title' => '#2 Membuat Jadwal',
                        'body' => 'Tetapkan jadwal kerja atau absensi untuk setiap user sesuai kebutuhan.',
                    ],
                    [
                        'title' => '#3 Aplikasi Siap',
                        'body' => 'Setelah data dan jadwal siap, aplikasi bisa digunakan untuk pencatatan kehadiran.',
                    ],
                    [
                        'title' => '#4 Download data',
                        'body' => 'Data kehadiran bisa diunduh dalam format Excel atau PDF.',
                    ],
                    [
                        'title' => '#5 Membuat laporan',
                        'body' => 'Laporan dapat dibuat berdasarkan filter waktu, status, dan pengguna.',
                    ],
                ];
            @endphp

            @foreach ($steps as $index => $step)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-controls="collapse{{ $index }}">
                            {{ $step['title'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}"
                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>{{ $step['body'] }}</strong>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
