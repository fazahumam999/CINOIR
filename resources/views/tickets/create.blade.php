@extends('layouts.app')

@section('title', 'Pesan Tiket')

@section('content')
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/dashboard" class="text-warning">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-warning">Tiket</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Pesan</li>
        </ol>
    </nav>
</div>

<div class="card mx-auto p-4" style="max-width: 600px;">
    <h2 class="mb-4">Pesan Tiket</h2>

    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Jadwal</label>
            <select name="schedule_id" class="form-select" required>
                @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}">
                        {{ $schedule->movie->judul }} - {{ $schedule->cinema->name }} ({{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('d M Y H:i') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Kursi</label>
            <input type="text" name="nomor_kursi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Pembeli</label>
            <input type="email" name="email_pembeli" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="terpesan">Terpesan</option>
                <option value="dibayar">Dibayar</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
        </div>

        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Simpan
        </button>
    </form>
</div>
@endsection
