@extends('fragment.navbar')

@section('navbar')
    <h2>Tambah Data Jurusan</h2>
    <form action="{{ route('jurusan.store') }}" method="POST">
        @csrf
        <label for="no_jurusan" class="form-label">Id Jurusan</label>
        <input type="text" id="no_jurusan" name="no_jurusan" class="form-control">
        <label for="jurusan" class="form-label">Nama Jurusan</label>
        <input type="text" id="jurusan" name="jurusan" class="form-control">
        <a href="{{ route('jurusan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        <button type="submit" class="btn btn-primary btn-sm">Tambah Data</button>
    </form>
@endsection

