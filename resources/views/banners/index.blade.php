@extends('layouts.app')

@section('title', 'Daftar Banner')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Banner Promosi</h2>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-success">+ Tambah Banner</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($banners->isEmpty())
        <p class="text-muted">Belum ada banner ditambahkan.</p>
    @else
        <div class="row">
            @foreach ($banners as $banner)
        <div class="col-md-4 mb-4">
             <div class="card shadow-sm">
             @if ($banner->type === 'image' && $banner->image)
            <img src="{{ asset('storage/' . $banner->image) }}" class="card-img-top" alt="{{ $banner->title }}">
             @elseif ($banner->type === 'video' && $banner->video)
            <video class="w-100" height="200" controls muted>
                <source src="{{ asset('storage/' . $banner->video) }}" type="video/mp4">
                Browser tidak mendukung video.
            </video>
        @endif

        <div class="card-body">
            <h5 class="card-title">{{ $banner->title }}</h5>
            <p class="card-text text-muted">{{ $banner->description }}</p>
        </div>
    </div>
</div>
            @endforeach
        </div>
    @endif
</div>
@endsection
