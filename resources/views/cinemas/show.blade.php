@extends('layouts.app')

@section('content')
    <h1>Detail Bioskop</h1>

    <p><strong>Nama:</strong> {{ $cinema->name }}</p>
    <p><strong>Lokasi:</strong> {{ $cinema->location }}</p>

    <a href="{{ route('cinemas.index') }}">← Kembali ke daftar</a>
@endsection
