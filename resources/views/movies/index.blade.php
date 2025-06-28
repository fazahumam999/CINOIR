@extends('layouts.app')

@section('title', 'Daftar Film')

@section('content')
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/dashboard" class="text-warning">Dashboard</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Film</li>
        </ol>
    </nav>
</div>


<div class="card border-0 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-warning text-dark fw-bold">
        <span><i class="bi bi-collection-play-fill"></i> Data Film</span>
        <a href="{{ route('movies.create') }}" class="btn btn-success">+ Tambah Film</a>
    </div>
    <div class="card-body bg-white rounded-bottom">
        <div class="table-responsive">
        
            <table id="dataTable" class="table table-striped table-bordered">
                <thead class="table-warning text-dark">
                    <tr>
                        <th width="5%">#</th>
                        <th>Judul</th>
                        <th>Genre</th>
                        <th>Durasi</th>
                        <th>Sinopsis</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $index => $movie)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $movie->judul }}</td>
                            <td>{{ $movie->genre }}</td>
                            <td>{{ $movie->durasi }} menit</td>
                            <td>{{ $movie->sinopsis }}</td>

                            <td>
                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-warning">Ubah</a>
                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus bioskop ini?')" type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            responsive: true,
            paging: true,
            ordering: true,
            searching: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                },
                zeroRecords: "Tidak ditemukan data",
                infoEmpty: "Menampilkan 0 dari 0 data",
            }
        });
    });
</script>
@endpush
