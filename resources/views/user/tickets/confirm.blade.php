@extends('layouts.navbar')

@section('content')
<main class="bg-gray-900 text-white min-h-screen py-8">
    <div class="max-w-3xl mx-auto p-6 bg-gray-800 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Konfirmasi Tiket</h1>

        <p><strong>Film:</strong> {{ $schedule->movie->judul }}</p>
        <p><strong>Bioskop:</strong> {{ $schedule->cinema->name }}</p>
        <p><strong>Waktu Tayang:</strong> {{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('d M Y, H:i') }}</p>
        <p><strong>Kursi:</strong> {{ implode(', ', $selected_seats) }}</p>
        <p><strong>Harga per Kursi:</strong> Rp{{ number_format($harga_satuan, 0, ',', '.') }}</p>
        <p><strong>Total Harga:</strong> <span class="text-green-400 font-bold">Rp{{ number_format($total_harga, 0, ',', '.') }}</span></p>

        <form action="{{ route('tickets.book') }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
            @foreach ($selected_seats as $seat)
                <input type="hidden" name="seats[]" value="{{ $seat }}">
            @endforeach

            <div class="mb-4">
                <label for="nama" class="block text-sm font-semibold">Nama</label>
                <input type="text" name="nama_pembeli" id="nama" required class="w-full mt-1 p-2 bg-gray-700 rounded border border-gray-600">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold">Email</label>
                <input type="email" name="email_pembeli" id="email" required class="w-full mt-1 p-2 bg-gray-700 rounded border border-gray-600">
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white font-semibold">Konfirmasi & Bayar</button>
        </form>
    </div>
</main>
@endsection


