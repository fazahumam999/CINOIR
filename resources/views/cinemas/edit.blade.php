@extends('layouts.app')

@section('title', 'Edit Bioskop')

@section('content')
    <div class="card mx-auto p-4" style="max-width: 600px;">
        <h2 class="mb-4">Edit Bioskop</h2>

        <form action="{{ route('admin.cinemas.update', $cinema->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Bioskop</label>
                <input type="text" name="name" class="form-control" value="{{ $cinema->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Kursi</label>
                <input type="number" name="total_kursi" class="form-control" value="{{ $cinema->total_kursi }}" required>
            </div>

            <a href="{{ route('admin.cinemas.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
