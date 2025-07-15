@extends('layouts.app')

@section('title', 'Daftar Film')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-collection-play-fill me-2"></i>Daftar Film</span>
        <a href="{{ route('admin.movies.create') }}" class="btn btn-sm btn-primary">+ Tambah Film</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Judul</th>
                        <th>Genre</th>
                        <th>Durasi</th>
                        <th>Sinopsis</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Poster</th>
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
                            <td>{{ $movie->rating ?? '0' }}</td>
                            <td>{{ $movie->status ?? '-' }}</td>
                            <td>
                                @if ($movie->poster)
                                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" width="60">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                            <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-sm btn-outline-secondary">Ubah</a>
                                <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus film ini?')" type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
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