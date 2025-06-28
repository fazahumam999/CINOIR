@extends('layouts.app')

@section('title', 'Edit Jadwal Tayang')

@section('content')
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/dashboard" class="text-warning">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('schedules.index') }}" class="text-warning">Jadwal</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Edit</li>
        </ol>
    </nav>
</div>

<div class="card mx-auto p-4" style="max-width: 600px;">
    <h2 class="mb-4">Edit Jadwal Tayang</h2>

    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Film</label>
            <select name="movie_id" class="form-select">
                @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}" {{ $schedule->movie_id == $movie->id ? 'selected' : '' }}>
                        {{ $movie->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Bioskop</label>
            <select name="cinema_id" class="form-select">
                @foreach ($cinemas as $cinema)
                    <option value="{{ $cinema->id }}" {{ $schedule->cinema_id == $cinema->id ? 'selected' : '' }}>
                        {{ $cinema->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu Mulai</label>
            <input type="datetime-local" name="waktu_mulai" class="form-control" value="{{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('Y-m-d\TH:i') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Tiket</label>
            <input type="number" name="harga" class="form-control" value="{{ $schedule->harga }}">
        </div>

        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Update
        </button>
    </form>
</div>
@endsection
