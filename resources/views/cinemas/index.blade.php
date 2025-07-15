@extends('layouts.app')

@section('title', 'Daftar Bioskop')

@section('content')

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-collection-play-fill me-2"></i>Daftar Bioskop</span>
        <a href="{{ route('admin.cinemas.create') }}" class="btn btn-sm btn-primary">+ Tambah Bioskop</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Nama Bioskop</th>
                        <th>Kota</th>
                        <th>Foto</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cinemas as $index => $cinema)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $cinema->name }}</td>
                            <td>{{ $cinema->kota ?? '-' }}</td>
                            <td>
                                @if($cinema->image)
                                    <img src="{{ asset('storage/' . $cinema->image) }}" alt="Foto Bioskop" width="100">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>
                            <a href="{{ route('admin.cinemas.edit', $cinema->id) }}" class="btn btn-sm btn-outline-secondary">Ubah</a>
                                <form action="{{ route('admin.cinemas.destroy', $cinema->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus bioskop ini?')" type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
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