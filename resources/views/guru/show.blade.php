@extends('fragment.navbar')

@section('navbar')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Detail Data Karyawan / Guru</h2>

    <form class="card shadow-sm p-4">
        <div class="mb-3">
            <label for="no_guru" class="form-label">ID Karyawan/Guru</label>
            <input type="number" id="no_guru" class="form-control" value="{{ $show->no_guru }}" disabled>
        </div>

        <div class="mb-3">
            <label for="nama_guru" class="form-label">Nama Karyawan/Guru</label>
            <input type="text" id="nama_guru" class="form-control" value="{{ $show->nama_guru }}" disabled>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <input type="text" id="jenis_kelamin" class="form-control" value="{{ $show->jenis_kelamin }}" disabled>
        </div>

        <div class="mb-3">
            <label for="karyawan" class="form-label">Role</label>
            <select id="karyawan" name="karyawan" class="form-select" disabled>
                <option value="Karyawan" {{ $show->karyawan == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                <option value="Guru" {{ $show->karyawan == 'Guru' ? 'selected' : '' }}>Guru</option>
            </select>
            <div class="form-text">
                * Jika ingin melihat jadwal dan jurusan guru, pilih "Guru" lagi.
            </div>
        </div>

        <!-- Jadwal Karyawan -->
        <div id="karyawanFields" class="mb-3">
            <label for="id_jadwalkaryawan" class="form-label">Jadwal Karyawan</label>
            <input type="text" class="form-control" value="{{ optional($show->jadwalkr)->no_jadwal }}" disabled>
        </div>

        <!-- Jadwal & Jurusan Guru -->
        <div id="guruFields" class="mb-3" style="display: none;">
            <div class="mb-3">
                <label for="id_jurusan" class="form-label">Jurusan</label>
                <input type="text" class="form-control" value="{{ optional($show->jurusan)->jurusan }}" disabled>
            </div>

            <div class="mb-3">
                <label for="id_jadwalguru" class="form-label">Jadwal Guru</label>
                <input type="text" class="form-control" value="{{ optional($show->jadwalgr)->no_jadwalguru }}" disabled>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('guru.index') }}" class="btn btn-outline-secondary">Kembali</a>
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
        } else {
            guruFields.style.display = 'none';
            karyawanFields.style.display = 'block';
        }
    }

    // Trigger saat halaman pertama kali dibuka
    window.onload = toggleRoleFields;
    // Bisa juga diubah saat pilihan diubah
    roleSelect.addEventListener('change', toggleRoleFields);
</script>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endsection
