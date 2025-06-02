@extends('fragment.navbar')

@section('navbar')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Edit Data Karyawan / Guru</h2>

    <form action="{{ route('guru.update', $guruedit->id) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="no_guru" class="form-label">ID Karyawan/Guru</label>
            <input type="number" id="no_guru" name="no_guru" class="form-control" value="{{ $guruedit->no_guru }}" readonly>
        </div>

        <div class="mb-3">
            <label for="nama_guru" class="form-label">Nama Karyawan/Guru</label>
            <input type="text" id="nama_guru" name="nama_guru" class="form-control" value="{{ $guruedit->nama_guru }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                <option disabled>-- Pilih Jenis Kelamin --</option>
                <option value="Laki_Laki" {{ $guruedit->jenis_kelamin == 'Laki_Laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="Perempuan" {{ $guruedit->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="karyawan" class="form-label">Role</label>
            <select id="karyawan" name="karyawan" class="form-select" required>
                <option disabled>-- Pilih Role --</option>
                <option value="Karyawan" {{ $guruedit->karyawan == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                <option value="Guru" {{ $guruedit->karyawan == 'Guru' ? 'selected' : '' }}>Guru</option>
            </select>
            <div class="form-text">
                * Jika ingin mengubah data jurusan atau jadwal guru, silakan klik ulang opsi "Guru"
            </div>
        </div>

        <!-- Karyawan Fields -->
        <div id="karyawanFields" class="mb-3">
            <label for="id_jadwalkaryawan" class="form-label">Jadwal Karyawan</label>
            <select id="id_jadwalkaryawan" name="id_jadwalkaryawan" class="form-select">
                <option disabled>Pilih Jadwal</option>
                @foreach ($jadwalkr as $karyawan)
                    <option value="{{ $karyawan->id }}" {{ $guruedit->id_jadwalkaryawan == $karyawan->id ? 'selected' : '' }}>
                        {{ $karyawan->no_jadwal }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Guru Fields -->
        <div id="guruFields" class="mb-3" style="display: none;">
            <div class="mb-3">
                <label for="id_jurusan" class="form-label">Jurusan</label>
                <select id="id_jurusan" name="id_jurusan" class="form-select">
                    <option disabled>Pilih Jurusan</option>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ $guruedit->id_jurusan == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_jadwalguru" class="form-label">Jadwal Guru</label>
                <select id="id_jadwalguru" name="id_jadwalguru" class="form-select">
                    <option disabled>Pilih Jadwal</option>
                    @foreach ($jadwalguru as $guru)
                        <option value="{{ $guru->id }}" {{ $guruedit->id_jadwalguru == $guru->id ? 'selected' : '' }}>
                            {{ $guru->no_jadwalguru }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('guru.index') }}" class="btn btn-outline-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
    const roleSelect = document.getElementById('karyawan');
    const guruFields = document.getElementById('guruFields');
    const karyawanFields = document.getElementById('karyawanFields');

    function toggleRoleFields() {
        if (roleSelect.value === 'Guru') {
            guruFields.style.display = 'block';
            karyawanFields.style.display = 'none';
            document.getElementById('id_jadwalkaryawan').value = '';
        } else {
            guruFields.style.display = 'none';
            karyawanFields.style.display = 'block';
            document.getElementById('id_jurusan').value = '';
            document.getElementById('id_jadwalguru').value = '';
        }
    }

    // Trigger on load
    window.onload = toggleRoleFields;
    // Trigger on change
    roleSelect.addEventListener('change', toggleRoleFields);
</script>
@endsection
