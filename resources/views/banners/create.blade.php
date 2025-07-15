@extends('layouts.app')
@section('title', 'Tambah Banner')
@section('content')

<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-warning">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}" class="text-warning">Banner Promosi</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Tambah</li>
        </ol>
    </nav>
</div>

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
        </div

        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Simpan
        </button>
    </form>
</div>
@endsection
