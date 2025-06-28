@extends('layouts.app')

@section('title', 'Daftar Tiket')

@section('content')
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/dashboard" class="text-warning">Dashboard</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Tiket</li>
        </ol>
    </nav>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-warning text-dark fw-bold">
        <span><i class="bi bi-ticket-perforated"></i> Daftar Tiket</span>
        <a href="{{ route('tickets.create') }}" class="btn btn-success">+ Pesan Tiket</a>
    </div>
    <div class="card-body bg-white rounded-bottom">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered">
                <thead class="table-warning text-dark">
                    <tr>
                        <th>Film</th>
                        <th>Nomor Kursi</th>
                        <th>Nama Pembeli</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->schedule->movie->judul }}</td>
                            <td>{{ $ticket->nomor_kursi }}</td>
                            <td>{{ $ticket->nama_pembeli }}</td>
                            <td>{{ $ticket->email_pembeli }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($ticket->status) }}</span></td>
                            <td>
                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning">Ubah</a>
                                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus tiket ini?')" type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
