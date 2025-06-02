@extends('fragment.navbar')

@section('navbar')
    <div class="container mt-5">
        <h1>Data Jurusan</h1>
        <a href="{{ route('jurusan.create') }}" class="btn btn-primary">Tambah Data Jurusan</a>
          <!-- Search Form -->
    <form method="GET" action="{{ route('jurusan.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Jurusan..." value="{{ request('search') }}" />
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Jurusan</th>
                    <th>Nama Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurusans as $jurusan)
                    <tr>
                        <td>{{ $jurusan->no_jurusan }}</td>
                        <td>{{ $jurusan->jurusan }}</td>
                        <td class="">
                          <a href="{{ route('jurusan.edit',$jurusan->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                          <form action="{{ route('jurusan.destroy',$jurusan->id) }}" method="POST" style="display: inline-block">
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
                    <a class="page-link" href="{{ $jurusans->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $jurusans->lastPage(); $i++)
                    <li class="page-item {{ $jurusans->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $jurusans->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $jurusans->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

         {{-- {{ $jurusans->appends(['search' => request('search')])}} --}}
        {{-- pagination end --}}
    </div>
@endsection
