@extends('layouts.app')

@section('title', 'Edit Bioskop')

@section('content')
    <div class="card mx-auto p-4" style="max-width: 600px;">
        <h2 class="mb-4">Edit Bioskop</h2>

        <form action="{{ route('admin.cinemas.update', $cinema->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Bioskop</label>
                <input type="text" name="name" class="form-control" value="{{ $cinema->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kota</label>
                <input type="text" name="kota" class="form-control" value="{{ $cinema->kota }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Bioskop</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if ($cinema->image)
                    <img src="{{ asset('storage/' . $cinema->image) }}" alt="Foto Bioskop" class="img-fluid mt-2" style="max-height: 150px;">
                @endif
            </div>

            <a href="{{ route('admin.cinemas.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
