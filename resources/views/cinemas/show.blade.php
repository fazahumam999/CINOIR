@extends('layouts.app')

@section('title', 'Detail Bioskop')

@section('content')
    <div class="card mx-auto p-4" style="max-width: 600px;">
        <h2 class="mb-4">Detail Bioskop</h2>

        <p><strong>Nama:</strong> {{ $cinema->name }}</p>
        <p><strong>Kota:</strong> {{ $cinema->kota ?? '-' }}</p>

        <div class="mb-3">
            <strong>Foto:</strong><br>
            @if ($cinema->image)
                <img src="{{ asset('storage/' . $cinema->image) }}" alt="Foto Bioskop" class="img-fluid mt-2" style="max-height: 200px;">
            @else
                <p class="text-muted">Tidak ada gambar tersedia.</p>
            @endif
        </div>

        <a href="{{ route('admin.cinemas.index') }}" class="btn btn-secondary mt-3">← Kembali ke Daftar</a>
    </div>
@endsection
