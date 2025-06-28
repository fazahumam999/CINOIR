@extends('layouts.app')

@section('title', 'Edit Film')

@section('content')
    <div class="card mx-auto p-4" style="max-width: 600px;">
        <h2 class="mb-4">Edit Bioskop</h2>

        <form action="{{ route('movies.update', $movie->id) }}" method="POST">
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

            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
