@extends('fragment.navbar')

@section('navbar')
     <h2>Ubah Data Ijin/Cuti Atau Sakit</h2>
    <form action="{{ route('ijin.update',$ijinedit->id) }}" method="POST">
        @csrf
        @method('PUT')
         <label for="id_nama" class="form-label">Jadwal Guru</label>
            <select id="id_nama" name="id_nama" class="form-select">
                <option selected value="{{ $ijinedit->id }}">{{ $ijinedit->guru->nama_guru }}</option>
               @foreach ($gurus as $guru)
                   <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
               @endforeach
            </select>
        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
        <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" value="{{ $ijinedit->tanggal_mulai }}">
        <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
        <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" class="form-control" value="{{ $ijinedit->tanggal_berakhir }}">
         <label for="keterangan" class="form-label">Keterangan</label>
            <select id="keterangan" name="keterangan" class="form-select">
                <option selected value="{{ $ijinedit->keterangan }}">{{ $ijinedit->keterangan }}</option>
                <option value="IJIN/CUTI">IJIN/CUTI</option>
                <option value="SAKIT">SAKIT</option>
            </select>
        <a href="{{ route('ijin.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        <button type="submit" class="btn btn-primary btn-sm">Tambah Data</button>
    </form>
@endsection
