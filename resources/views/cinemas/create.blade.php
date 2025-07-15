@extends('layouts.app')
@section('title', 'Tambah Bioskop')
@section('content')

<div class="card mx-auto p-4" style="max-width: 600px;">
    <h2 class="mb-4">Tambah Bioskop</h2>

    <form action="{{ route('admin.cinemas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Bioskop</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kota</label>
            <input type="text" name="kota" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Bioskop</label>
            <input type="file" name="image" class="form-control">
        </div>

        <a href="{{ route('admin.cinemas.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan
    </form>
</div>

@endsection