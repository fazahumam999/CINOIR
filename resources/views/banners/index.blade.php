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
                        <img src="{{ asset('storage/' . $banner->image) }}" class="card-img-top" alt="{{ $banner->title }}">
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
