@extends('layouts.app')

@section('title', 'Edit Tiket')

@section('content')
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-warning">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tickets.index') }}" class="text-warning">Tiket</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Edit</li>
        </ol>
    </nav>
</div>

<div class="card mx-auto p-4" style="max-width: 600px;">
    <h2 class="mb-4">Edit Tiket</h2>

    <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Jadwal</label>
            <select name="schedule_id" class="form-select">
                @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}" {{ $ticket->schedule_id == $schedule->id ? 'selected' : '' }}>
                        {{ $schedule->movie->judul }} - {{ $schedule->cinema->name }} ({{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('d M Y H:i') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Kursi</label>
            <input type="text" name="nomor_kursi" class="form-control" value="{{ $ticket->nomor_kursi }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" value="{{ $ticket->nama_pembeli }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Pembeli</label>
            <input type="email" name="email_pembeli" class="form-control" value="{{ $ticket->email_pembeli }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="terpesan" {{ $ticket->status == 'terpesan' ? 'selected' : '' }}>Terpesan</option>
                <option value="dibayar" {{ $ticket->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                <option value="dibatalkan" {{ $ticket->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
        <button type="submit" class="btn btn-warning text-dark fw-bold">
            <i class="bi bi-pencil-square"></i> Update
        </button>
    </form>
</div>
@endsection
