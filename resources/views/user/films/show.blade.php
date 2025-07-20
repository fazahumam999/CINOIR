@extends('layouts.navbar')

@section('content')
<main class="flex-grow bg-gray-900 text-white min-h-screen py-12">
    <div class="container mx-auto px-6">
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            
            {{-- Poster Film --}}
            <div class="md:w-1/3">
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->judul }}"
                    class="w-full h-auto object-cover md:h-full rounded-l-xl">
            </div>

            {{-- Detail Film --}}
<div class="md:w-2/3 p-6 flex flex-col justify-between">
    <div>
        <h1 class="text-3xl font-bold mb-2 text-blue-400">{{ $movie->judul }}</h1>
        <p class="text-sm text-gray-400 mb-1">{{ $movie->genre }} • {{ $movie->durasi }} Menit</p>
        <hr class="border-gray-600 my-4">

        <h2 class="text-xl font-semibold mb-2 text-white">Sinopsis</h2>
        <p class="text-gray-300 leading-relaxed mb-6">
            {{ $movie->sinopsis ?? 'Sinopsis belum tersedia.' }}
        </p>

        {{-- Tombol langsung di bawah sinopsis --}}
        <a href="{{ route('cinemas.index') }}#our-cinema"
   class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
   Select Cinema
</a>

    </div>
</div>


        </div>
    </div>

</main>
@endsection
