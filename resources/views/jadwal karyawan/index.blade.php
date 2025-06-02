@extends('fragment.navbar')

@section('navbar')
    <div class="container mt-5">
        <h1>Jadwal Karyawan</h1>
        <a href="{{ route('jadwalkaryawan.create') }}" class="btn btn-primary">Tambah Data Jadwal guru</a>
          <!-- Search Form -->
    <form method="GET" action="{{ route('jadwalkaryawan.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Jurusan..." value="{{ request('search') }}" />
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Jadwal</th>
                    <th>Hari</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $karyawan)
                    <tr>
                        <td>{{ $karyawan->no_jadwal}}</td>
                        <td>{{ $karyawan->hari }}</td>
                        <td>{{ $karyawan->masuk }}</td>
                        <td>{{ $karyawan->pulang }}</td>
                        <td class="">
                          <a href="{{ route('jadwalkaryawan.show',$karyawan->id) }}" class="btn btn-secondary btn-sm">Lihat</a>
                          <a href="{{ route('jadwalkaryawan.edit',$karyawan->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                          <form action="{{ route('jadwalkaryawan.destroy',$karyawan->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                          </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- pagination --}}
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="{{ $karyawans->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $karyawans->lastPage(); $i++)
                    <li class="page-item {{ $karyawans->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $karyawans->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $karyawans->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
@endsection
