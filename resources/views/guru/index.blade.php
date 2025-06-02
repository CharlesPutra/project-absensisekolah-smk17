@extends('fragment.navbar')

@section('navbar')
     <div class="container mt-5">
        <h1>Data Karyawan/Guru</h1>
        <a href="{{ route('guru.create') }}" class="btn btn-primary">Tambah Data  Karyawan/Guru</a>
          <!-- Search Form -->
    <form method="GET" action="{{ route('guru.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Jurusan..." value="{{ request('search') }}" />
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Id Karyawan</th>
                    <th>Nama Karyawan/Guru</th>
                    <th>Kelamin</th>
                    <th>Jabatan</th>
                    <th>Jurusan</th> 
                    <th>Jadwal Karyawan</th> 
                    <th>Jadwal Guru</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gurus as $guru)
                    <tr>
                        <td>{{ $guru->no_guru }}</td>
                        <td>{{ $guru->nama_guru }}</td>
                        <td>{{ $guru->jenis_kelamin }}</td>
                        <td>{{ $guru->karyawan }}</td>
                      <td>{{ optional($guru->jurusan)->no_jurusan }}</td>
                      <td>{{ optional($guru->jadwalkr)->no_jadwal }}</td>
                      <td>{{ optional($guru->jadwalgr)->no_jadwalguru }}</td>
                        {{-- <td>{{ $guru->jadwalkr- }}</td> --}}
                        <td class="">
                          <a href="{{ route('guru.show',$guru->id) }}" class="btn btn-secondary btn-sm">Lihat</a>
                          <a href="{{ route('guru.edit',$guru->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                          <form action="{{ route('guru.destroy',$guru->id) }}" method="POST" style="display: inline-block">
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
                    <a class="page-link" href="{{ $gurus->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $gurus->lastPage(); $i++)
                    <li class="page-item {{ $gurus->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $gurus->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $gurus->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

         {{-- {{ $jadwalgurus->appends(['search' => request('search')])}} --}}
        {{-- pagination end --}}
    </div>
@endsection
