@extends('layouts.app')
@section('title', 'Edit Banner')
@section('content')

<div class="card mx-auto p-4" style="max-width: 600px;">
    <h2 class="mb-4">Edit Banner Promosi</h2>

    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Banner</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <input type="text" name="description" class="form-control" value="{{ old('description', $banner->description) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Banner</label>
            @if ($banner->image)
                <div class="mb-2">
                    <img src="{{ asset($banner->image) }}" alt="Banner Image" style="max-height: 120px;">
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Video Banner</label>
            @if ($banner->video)
                <div class="mb-2">
                    <video controls style="max-width: 100%;">
                        <source src="{{ asset($banner->video) }}">
                        Browser tidak mendukung video.
                    </video>
                </div>
            @endif
            <input type="file" name="video" class="form-control" accept="video/mp4,video/webm,video/ogg">
            <small class="text-muted">Format yang didukung: MP4, WebM, OGG</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe Banner</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $banner->type) }}">
        </div>

        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection
