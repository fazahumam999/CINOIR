@extends('layouts.app')

@section('title', 'Edit Film')

@section('content')
    <div class="card mx-auto p-4" style="max-width: 600px;">
        <h2 class="mb-4">Edit Bioskop</h2>

        <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $movie->judul }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" name="genre" class="form-control" value="{{ $movie->genre }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sinopsis</label>
                <input type="text" name="sinopsis" class="form-control" value="{{ $movie->sinopsis }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Durasi</label>
                <input type="text" name="durasi" class="form-control" value="{{ $movie->durasi }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rating</label>
                <input type="number" name="rating" step="0.1" class="form-control" value="{{ $movie->rating }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="now" {{ $movie->status == 'now' ? 'selected' : '' }}>Now Showing</option>
                    <option value="coming" {{ $movie->status == 'coming' ? 'selected' : '' }}>Coming Soon</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Poster</label>
                @if ($movie->poster)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" width="100">
                    </div>
                @endif
                <input type="file" name="poster" class="form-control">
            </div>

            <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection