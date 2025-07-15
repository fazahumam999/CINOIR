@extends('layouts.app')
@section('title', 'Tambah Film')
@section('content')


<div class="card mx-auto p-4" style="max-width: 600px;">
    <h2 class="mb-4">Tambah Film</h2>

    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sinopsis</label>
            <input type="text" name="sinopsis" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Durasi (Menit)</label>
            <input type="number" name="durasi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <input type="number" step="0.1" name="rating" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Poster</label>
            <input type="file" name="poster" accept="image/*" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="now">Now Showing</option>
                <option value="soon">Coming Soon</option>
            </select>
        </div>

        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

@endsection
