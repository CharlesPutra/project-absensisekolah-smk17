@extends('fragment.navbar')

@section('navbar')
     <div class="container mt-5">
        <h1>Jadwal Guru</h1>
        <a href="{{ route('jadwalguru.create') }}" class="btn btn-primary">Tambah Data Jadwal guru</a>
          <!-- Search Form -->
    <form method="GET" action="{{ route('jadwalguru.index') }}" class="mb-4">
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
                    <th>Jurusan</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwalgurus as $guru)
                    <tr>
                        <td>{{ $guru->no_jadwalguru }}</td>
                        <td>{{ $guru->hari }}</td>
                        <td>{{ $guru->jurusan->no_jurusan }}</td>
                        <td>{{ $guru->masuk }}</td>
                        <td>{{ $guru->pulang }}</td>
                        <td class="">
                          <a href="{{ route('jadwalguru.show',$guru->id) }}" class="btn btn-secondary btn-sm">Lihat</a>
                          <a href="{{ route('jadwalguru.edit',$guru->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                          <form action="{{ route('jadwalguru.destroy',$guru->id) }}" method="POST" style="display: inline-block">
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
                    <a class="page-link" href="{{ $jadwalgurus->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $jadwalgurus->lastPage(); $i++)
                    <li class="page-item {{ $jadwalgurus->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $jadwalgurus->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $jadwalgurus->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
@endsection
