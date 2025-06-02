 @extends('fragment.navbar')

 @section('navbar')
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
 @endsection
 