@extends('fragment.navbar')

@section('navbar')
     <div class="container mt-5">
        <h1>Ijin/Cuti Atau Sakit</h1>
        <a href="{{ route('ijin.create') }}" class="btn btn-primary">Tambah Data Ijin/Sakit</a>
          <!-- Search Form -->
    <form method="GET" action="{{ route('ijin.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Jurusan..." value="{{ request('search') }}" />
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Karyawan/Guru</th>
                    <th>Mulai</th>
                    <th>Berakhir</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ijins as $ijin)
                    <tr>
                        <td>{{ $ijin->guru->nama_guru }}</td>
                        <td>{{ $ijin->tanggal_mulai }}</td>
                        <td>{{ $ijin->tanggal_berakhir }}</td>
                        <td>{{ $ijin->keterangan }}</td>
                        <td class="">
                          <a href="{{ route('ijin.show',$ijin->id) }}" class="btn btn-secondary btn-sm">Lihat</a>
                          <a href="{{ route('ijin.edit',$ijin->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                          <form action="{{ route('ijin.destroy',$ijin->id) }}" method="POST" style="display: inline-block">
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
                    <a class="page-link" href="{{$ijins->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <=$ijins->lastPage(); $i++)
                    <li class="page-item {{$ijins->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{$ijins->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{$ijins->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
@endsection
