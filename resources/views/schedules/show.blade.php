@extends('layouts.app')

@section('content')
    <h1>Detail Jadwal Tayang</h1>

    <p><strong>Film:</strong> {{ $schedule->movie->judul }}</p>
    <p><strong>Bioskop:</strong> {{ $schedule->cinema->nama }}</p>
    <p><strong>Waktu Mulai:</strong> {{ $schedule->waktu_mulai }}</p>
    <p><strong>Harga:</strong> Rp{{ number_format($schedule->harga, 0, ',', '.') }}</p>

    <a href="{{ route('admin.schedules.index') }}">← Kembali ke daftar</a>
@endsection
