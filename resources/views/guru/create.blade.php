@extends('fragment.navbar')

@section('navbar')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Tambah Data Karyawan / Guru</h2>

    <form action="{{ route('guru.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="mb-3">
            <label for="no_guru" class="form-label">ID Karyawan/Guru</label>
            <input type="number" id="no_guru" name="no_guru" class="form-control" value="{{ $nextNoGuru }}" readonly>
        </div>

        <div class="mb-3">
            <label for="nama_guru" class="form-label">Nama Karyawan/Guru</label>
            <input type="text" id="nama_guru" name="nama_guru" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                <option disabled selected>-- Pilih Jenis Kelamin --</option>
                <option value="Laki_Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="karyawan" class="form-label">Pilih Role</label>
            <select id="karyawan" name="karyawan" class="form-select" required>
                <option disabled selected>-- Pilih Salah Satu --</option>
                <option value="Karyawan">Karyawan</option>
                <option value="Guru">Guru</option>
            </select>
        </div>

        <!-- Karyawan Fields -->
        <div id="karyawanFields" class="mb-3">
            <label for="id_jadwalkaryawan" class="form-label">Jadwal Karyawan</label>
            <select id="id_jadwalkaryawan" name="id_jadwalkaryawan" class="form-select">
                <option disabled selected>Pilih Jadwal</option>
                @foreach ($jadwalkr as $karyawan)
                    <option value="{{ $karyawan->id }}">{{ $karyawan->no_jadwal }}</option>
                @endforeach
            </select>
        </div>

        <!-- Guru Fields -->
        <div id="guruFields" class="mb-3" style="display: none;">
            <div class="mb-3">
                <label for="id_jurusan" class="form-label">Jurusan</label>
                <select id="id_jurusan" name="id_jurusan" class="form-select">
                    <option disabled selected>Pilih Jurusan</option>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_jadwalguru" class="form-label">Jadwal Guru</label>
                <select id="id_jadwalguru" name="id_jadwalguru" class="form-select">
                    <option disabled selected>Pilih Jadwal</option>
                    @foreach ($jadwalguru as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->no_jadwalguru }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('guru.index') }}" class="btn btn-outline-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
    </form>
</div>

<!-- Script Role Switching -->
<script>
    const roleSelect = document.getElementById('karyawan');
    const guruFields = document.getElementById('guruFields');
    const karyawanFields = document.getElementById('karyawanFields');

    roleSelect.addEventListener('change', () => {
        if (roleSelect.value === 'Guru') {
            guruFields.style.display = 'block';
            karyawanFields.style.display = 'none';
            document.getElementById('id_jadwalkaryawan').value = '';
        } else if (roleSelect.value === 'Karyawan') {
            guruFields.style.display = 'none';
            karyawanFields.style.display = 'block';
            document.getElementById('id_jurusan').value = '';
            document.getElementById('id_jadwalguru').value = '';
        }
    });
</script>
@endsection
