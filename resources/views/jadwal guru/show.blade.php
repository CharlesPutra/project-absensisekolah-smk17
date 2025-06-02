@extends('fragment.navbar')

@section('navbar')
     <h2>Show Data Jadwal Guru</h2>
    <form action="{{ route('jadwalguru.update',$show->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="no_jadwalguru" class="form-label">Kode Jadwal</label>
        <input type="text" id="no_jadwalguru" name="no_jadwalguru" class="form-control" disabled value="{{ $show->no_jadwalguru }}">
        <label for="hari" class="form-label">Hari</label>
        <input type="text" id="hari" name="hari" class="form-control" value="{{ $show->hari }}" disabled>
        <label for="masuk" class="form-label">Jam Masuk</label>
        <input type="text" id="masuk" name="masuk" class="form-control" placeholder="CONTOH : PUKUL 06.30" value="{{ $show->masuk }}" disabled>
        <label for="pulang" class="form-label">Jam Pulang</label>
        <input type="text" id="pulang" name="pulang" class="form-control" placeholder="CONTOH : PUKUL 12.30" value="{{ $show->pulang }}" disabled>
        <label for="keterlambatan" class="form-label">Keterlambatan</label>
        <input type="text" id="keterlambatan" name="keterlambatan" class="form-control" placeholder="CONTOH : 120MENIT" value="{{ $show->keterlambatan }}" disabled>
        {{-- <label for="keterangan" class="form-label">keterangan</label>
        <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ $jadwaledit->keterangan }}"> --}}
        {{-- select --}}
        <label for="id_jurusan" class="form-label">Jurusan</label>
        <select id="id_jurusan" name="id_jurusan" class="form-select"  disabled>
            <option selected value="{{ $show->id_jurusan }}">{{ $show->jurusan->jurusan }}</option>
           @foreach ($jurusans as $jurusan)
               <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
           @endforeach
        </select>
        </div>
        {{-- select end --}}
        {{-- textarea --}}
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea id="keterangan" name="keterangan" class="form-control" disabled>{{ $show->keterangan }}</textarea>
        {{-- textarea end --}}
        <a href="{{ route('jadwalguru.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        {{-- <button type="submit" class="btn btn-warning btn-sm">Ubah Data</button> --}}
    </form>
@endsection
