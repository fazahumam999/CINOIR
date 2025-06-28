@extends('layouts.app')
@section('title', 'Tambah Film')
@section('content')

<div class="mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent px-0">
                <li class="breadcrumb-item"><a href="/dashboard" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('movies.index') }}" class="text-warning">Film</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
    <div class="card mx-auto p-4" style="max-width: 600px;">
        <h2 class="mb-4">Tambah Film</h2>

        <form action="{{ route('movies.store') }}" method="POST">
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
                <label class="form-label">Durasi (Menit) </label>
                <input type="number" name="durasi" class="form-control" required>
            </div>

            <a href="{{ route('movies.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>

        </form>
    </div>
@endsection
