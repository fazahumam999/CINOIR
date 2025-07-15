@extends('layouts.app')

@section('title', 'Daftar Tiket')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-ticket-perforated me-2"></i>Daftar Tiket</span>
        <a href="{{ route('admin.tickets.create') }}" class="btn btn-sm btn-primary">+ Pesan Tiket</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Film</th>
                        <th>Nomor Kursi</th>
                        <th>Nama Pembeli</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $index => $ticket)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ticket->schedule->movie->judul }}</td>
                            <td>{{ $ticket->nomor_kursi }}</td>
                            <td>{{ $ticket->nama_pembeli }}</td>
                            <td>{{ $ticket->email_pembeli }}</td>
                            <td>
                                <span class="badge 
                                    @if($ticket->status == 'confirmed') bg-success
                                    @elseif($ticket->status == 'pending') bg-warning text-dark
                                    @elseif($ticket->status == 'cancelled') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus tiket ini?')" type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data tiket.</td>
                        </tr>
                    @endforelse
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