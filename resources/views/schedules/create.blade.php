@extends('layouts.app')

@section('title', 'Tambah Jadwal Tayang')

@section('content')
    <div class="mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent px-0">
                <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.schedules.index') }}" class="text-warning">Jadwal</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card mx-auto p-4" style="max-width: 700px;">
        <h2 class="mb-4">Tambah Jadwal Tayang</h2>

        <form action="{{ route('admin.schedules.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Film</label>
                <select name="movie_id" class="form-select" required>
                    <option value="">-- Pilih Film --</option>
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Bioskop</label>
                <select name="cinema_id" class="form-select" required>
                    <option value="">-- Pilih Bioskop --</option>
                    @foreach ($cinemas as $cinema)
                        <option value="{{ $cinema->id }}">{{ $cinema->name ?? $cinema->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Waktu Mulai</label>
                <input type="datetime-local" name="waktu_mulai" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga Tiket</label>
                <input type="number" name="harga" class="form-control" min="0" required>
            </div>

            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan
            </button>
        </form>
    </div>
@endsection
