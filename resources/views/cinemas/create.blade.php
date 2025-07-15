@extends('layouts.app')
@section('title', 'Tambah Bioskop')
@section('content')

    <div class="card mx-auto p-4" style="max-width: 600px;">
        <h2 class="mb-4">Tambah Bioskop</h2>

        <form action="{{ route('admin.cinemas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Bioskop</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Kursi</label>
                <input type="number" name="total_kursi" class="form-control" required>
            </div>

            <a href="{{ route('admin.cinemas.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>

        </form>
    </div>
@endsection
