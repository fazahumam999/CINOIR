@extends('layouts.app')

@section('content')
    <h1>Detail Film</h1>

    <p><strong>Judul:</strong> {{ $movie->judul }}</p>
    <p><strong>Genre:</strong> {{ $movie->genre }}</p>
    <p><strong>Durasi:</strong> {{ $movie->durasi }} menit</p>
    <p><strong>Sinopsis:</strong> {{ $movie->sinopsis }}</p>

    <a href="{{ route('admin.movies.index') }}">← Kembali ke daftar</a>
@endsection
