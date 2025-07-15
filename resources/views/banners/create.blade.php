@extends('layouts.app')
@section('title', 'Tambah Banner')
@section('content')

<div class="card mx-auto p-4" style="max-width: 600px;">
    <h2 class="mb-4">Tambah Banner Promosi</h2>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Banner</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <input type="text" name="description" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Banner</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Video Banner</label>
            <input type="file" name="video" class="form-control" accept="video/mp4,video/webm,video/ogg">
            <small class="text-muted">Format yang didukung: MP4, WebM, OGG</small>
</div>

        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan
    </form>
</div>
@endsection
