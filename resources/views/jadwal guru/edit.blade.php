@extends('fragment.navbar')

@section('navbar')
    <h2>Ubah Data Jadwal Guru</h2>
    <form action="{{ route('jadwalguru.update',$jadwaledit->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="no_jadwalguru" class="form-label">Kode Jadwal</label>
        <input type="text" id="no_jadwalguru" name="no_jadwalguru" class="form-control" value="{{ $jadwaledit->no_jadwalguru }}">
        <label for="hari" class="form-label">Hari</label>
        <input type="text" id="hari" name="hari" class="form-control" value="{{ $jadwaledit->hari }}">
        <label for="masuk" class="form-label">Jam Masuk</label>
        <input type="text" id="masuk" name="masuk" class="form-control" placeholder="CONTOH : PUKUL 06.30" value="{{ $jadwaledit->masuk }}">
        <label for="pulang" class="form-label">Jam Pulang</label>
        <input type="text" id="pulang" name="pulang" class="form-control" placeholder="CONTOH : PUKUL 12.30" value="{{ $jadwaledit->pulang }}">
        <label for="keterlambatan" class="form-label">Keterlambatan</label>
        <input type="text" id="keterlambatan" name="keterlambatan" class="form-control" placeholder="CONTOH : 120MENIT" value="{{ $jadwaledit->keterlambatan }}">
        {{-- <label for="keterangan" class="form-label">keterangan</label>
        <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ $jadwaledit->keterangan }}"> --}}
        {{-- select --}}
        <label for="id_jurusan" class="form-label">Jurusan</label>
        <select id="id_jurusan" name="id_jurusan" class="form-select">
            <option selected value="{{ $jadwaledit->id_jurusan }}">{{ $jadwaledit->jurusan->jurusan }}</option>
           @foreach ($jurusans as $jurusan)
               <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
           @endforeach
        </select>
        </div>
        {{-- select end --}}
        {{-- textarea --}}
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea id="keterangan" name="keterangan" class="form-control">{{ $jadwaledit->keterangan }}</textarea>
        {{-- textarea end --}}
        <a href="{{ route('jadwalguru.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        <button type="submit" class="btn btn-warning btn-sm">Ubah Data</button>
    </form>
@endsection
