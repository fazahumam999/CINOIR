@extends('layouts.app')

@section('content')
    <h1>Detail Tiket</h1>

    <p><strong>Film:</strong> {{ $ticket->schedule->movie->judul }}</p>
    <p><strong>Bioskop:</strong> {{ $ticket->schedule->cinema->nama }}</p>
    <p><strong>Waktu Tayang:</strong> {{ $ticket->schedule->waktu_mulai }}</p>
    <p><strong>Nomor Kursi:</strong> {{ $ticket->nomor_kursi }}</p>
    <p><strong>Nama Pembeli:</strong> {{ $ticket->nama_pembeli }}</p>
    <p><strong>Email Pembeli:</strong> {{ $ticket->email_pembeli }}</p>
    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>

    <a href="{{ route('tickets.index') }}">← Kembali ke daftar</a>
@endsection
