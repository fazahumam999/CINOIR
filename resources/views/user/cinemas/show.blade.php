@extends('layouts.navbar')

@section('content')
<main class="bg-gray-900 text-white min-h-screen pt-6">

    {{-- HEADER BIOSKOP --}}
    <div class="max-w-6xl mx-auto px-4 mb-6">
        <h1 class="text-3xl font-bold">{{ $cinema->name }}</h1>
        <p class="text-gray-300">{{ $cinema->kota }}</p>
    </div>

    {{-- TAB TANGGAL --}}
    <div class="bg-gray-800 shadow">
        <div class="max-w-6xl mx-auto flex overflow-x-auto">
            @foreach ($tabs as $tab)
                @php
                    $active = $tab->toDateString() === $date;
                @endphp
                <a href="{{ route('cinemas.show', [$cinema, 'date' => $tab->toDateString()]) }}"
                   class="px-4 py-3 text-sm whitespace-nowrap border-b-2 {{ $active ? 'border-blue-500 text-white font-semibold' : 'border-transparent text-gray-400 hover:border-gray-500' }}">
                    {{ $tab->isoFormat('ddd DD/MM') }}
                </a>
            @endforeach
        </div>
    </div>

{{-- LIST FILM + JAM --}}
<div class="max-w-6xl mx-auto px-4 py-8 space-y-6">

    @forelse ($schedules as $movieId => $rows)
        @php $movie = $rows->first()->movie; @endphp

        <div x-data="{ open: false }" class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
            {{-- Header film (klik untuk toggle) --}}
            <div @click="open = !open" class="flex items-center p-4 cursor-pointer hover:bg-gray-700 transition">
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}"
                     class="w-24 h-36 object-cover rounded shadow mr-4">
                <div class="flex-1">
                    <h2 class="text-xl font-bold">{{ $movie->judul }}</h2>
                    <p class="text-gray-400 text-sm mt-1">{{ $movie->genre ?? 'Genre not set' }}</p>
                </div>
            </div>

            {{-- Konten dropdown --}}
            <div x-show="open" x-transition class="border-t border-gray-700 p-4">
                <div class="flex flex-wrap gap-3 items-center">
                    @foreach ($rows as $sch)
<a href="{{ route('tickets.selectSeat', $sch->id) }}"
   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm transition duration-200">
    {{ \Carbon\Carbon::parse($sch->waktu_mulai)->format('g:i A') }}
</a>

                    @endforeach
                </div>
                <p class="text-sm text-gray-400 mt-2">Price: Rp{{ number_format($rows->first()->harga ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

    @empty
        <p class="text-center text-gray-400">No sessions for this date.</p>
    @endforelse

</div>

</main>
@endsection
