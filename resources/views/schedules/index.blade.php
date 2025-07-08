@extends('layouts.app')

@section('title', 'Jadwal Tayang')

@section('content')
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-warning">Dashboard</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Jadwal Tayang</li>
        </ol>
    </nav>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-warning text-dark fw-bold">
        <span><i class="bi bi-calendar-event"></i> Jadwal Tayang</span>
        <a href="{{ route('admin.schedules.create') }}" class="btn btn-success">+ Tambah Jadwal</a>
    </div>
    <div class="card-body bg-white rounded-bottom">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered">
                <thead class="table-warning text-dark">
                    <tr>
                        <th>Film</th>
                        <th>Bioskop</th>
                        <th>Waktu Mulai</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->movie->judul }}</td>
                            <td>{{ $schedule->cinema->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('d M Y, H:i') }}</td>
                            <td>Rp{{ number_format($schedule->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning">Ubah</a>
                                <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus jadwal ini?')" type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama", last: "Terakhir", next: "›", previous: "‹"
                },
                zeroRecords: "Tidak ditemukan data",
                infoEmpty: "Menampilkan 0 dari 0 data"
            }
        });
    });
</script>
@endpush
