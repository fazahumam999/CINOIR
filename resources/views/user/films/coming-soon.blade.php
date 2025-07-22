@extends('layouts.navbar')

@section('content')
<main class="flex-grow bg-gray-900 text-white min-h-screen pt-12">
    <div class="container mx-auto px-4">
        {{-- Judul --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold tracking-wide flex items-center">
                <span class="w-2 h-8 bg-red-500 rounded mr-3"></span>
                Coming Soon
            </h1>

            <a href="{{ route('films.now_showing') }}"
            class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-gradient-to-r from-blue-600 to-blue-400 text-white font-semibold shadow-md transition-all duration-500 ease-in-out hover:from-blue-500 hover:to-indigo-500 hover:shadow-blue-500/50 transform hover:-translate-y-1 group">
            <i class="fas fa-calendar-alt text-white group-hover:translate-x-1 group-hover:rotate-6 transition-all duration-300 ease-in-out"></i>
            <span class="tracking-wider group-hover:tracking-widest transition-all duration-500"> Now Showing </span>
        </a>
        </div>

        {{-- Daftar Film --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($movies as $movie)
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->judul }}"
                         class="w-full h-96 object-cover">

                    <div class="p-4 text-black">
                        <h2 class="text-xl font-bold mb-1">{{ $movie->judul }}</h2>
                        <p class="text-sm text-gray-600 mb-2">
                            {{ $movie->genre }} • {{ $movie->durasi }} Menit
                        </p>
                        <a href="{{ route('user.films.show', $movie->id) }}" class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            View Detail
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 col-span-full">Tidak ada film yang akan datang saat ini.</p>
            @endforelse
        </div>
    </div>

    

</main>

@include('layouts.footer')

@endsection
