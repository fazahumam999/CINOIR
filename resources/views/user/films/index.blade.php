@extends('layouts.navbar')

@section('content')
<main class="flex-grow bg-gray-900 text-white min-h-screen pt-8">
    <section class="container mx-auto px-4 mb-12">
        <h2 class="text-3xl font-bold mb-6 flex items-center">
            <span class="bg-blue-600 w-2 h-8 mr-3"></span> Now Showing
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($nowShowing as $movie)
                <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->judul }}" class="w-full h-96 object-cover">
                    <div class="p-4 text-black">
                        <h3 class="font-bold text-xl mb-1">{{ $movie->judul }}</h3>
                        <p class="text-sm text-gray-600">{{ $movie->genre }} • {{ $movie->durasi }} Menit</p>
                        <a href="#" class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Times & Tickets
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-400">Tidak ada film tersedia.</p>
            @endforelse
        </div>
    </section>

    <section class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-6 flex items-center">
            <span class="bg-red-600 w-2 h-8 mr-3"></span> Coming Soon
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($comingSoon as $movie)
                <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->judul }}" class="w-full h-96 object-cover">
                    <div class="p-4 text-black">
                        <h3 class="font-bold text-xl mb-1">{{ $movie->judul }}</h3>
                        <p class="text-sm text-gray-600">{{ $movie->genre }} • {{ $movie->durasi }} Menit</p>
                        <a href="#" class="mt-2 inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-400">Belum ada film Coming Soon.</p>
            @endforelse
        </div>
    </section>
</main>
@endsection
