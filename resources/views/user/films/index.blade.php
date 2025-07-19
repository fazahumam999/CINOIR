@extends('layouts.navbar')

@section('content')
<main class="flex-grow bg-gray-900 text-white min-h-screen pt-8">

<div class="container mx-auto px-4 mb-12 relative">
    {{-- Tabs di Tengah --}}
    <div class="text-xl font-semibold tracking-wide flex justify-center gap-10">
        <a href="{{ route('films.now_showing') }}"
           class="transition duration-300 ease-in-out transform hover:scale-105 hover:text-blue-400 text-white">
            <span class="inline-block border-b-2 {{ request()->routeIs('films.now_showing') ? 'border-blue-400' : 'border-transparent hover:border-blue-400' }} pb-1">
                Now Showing
            </span>
        </a>
        <a href="{{ route('films.coming_soon') }}"
           class="transition duration-300 ease-in-out transform hover:scale-105 hover:text-red-400 text-white">
            <span class="inline-block border-b-2 {{ request()->routeIs('films.coming_soon') ? 'border-red-400' : 'border-transparent hover:border-red-400' }} pb-1">
                Coming Soon
            </span>
        </a>
    </div>

    {{-- Sort Dropdown di Kanan --}}
<form method="GET" action="{{ url()->current() }}"
      class="absolute right-0 top-0 text-sm text-white">
    <label for="sort" class="mr-2 font-semibold">Sort by:</label>
    <div class="relative inline-block w-48">
        <select name="sort" id="sort" onchange="this.form.submit()"
                class="block appearance-none w-full bg-gray-800 border border-gray-600 text-white py-2 pl-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            <option value="">Default</option>
            <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>Judul A–Z</option>
            <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Judul Z–A</option>
            <option value="durasi_asc" {{ request('sort') == 'durasi_asc' ? 'selected' : '' }}>Durasi Pendek–Panjang</option>
            <option value="durasi_desc" {{ request('sort') == 'durasi_desc' ? 'selected' : '' }}>Durasi Panjang–Pendek</option>
        </select>
        <!-- Custom Arrow -->
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path d="M5.516 7.548a.625.625 0 01.884 0L10 11.148l3.6-3.6a.625.625 0 01.884.884l-4.042 4.042a.625.625 0 01-.884 0L5.516 8.432a.625.625 0 010-.884z"/>
            </svg>
        </div>
    </div>
</form>

</div>

    {{-- NOW SHOWING --}}
    <section id="now-showing" class="container mx-auto px-4 mb-12">
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
                        <a href="{{ route('cinemas.index') }}" class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Times & Tickets
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-400">Tidak ada film tersedia.</p>
            @endforelse
        </div>
    </section>

    {{-- COMING SOON --}}
    <section id="coming-soon" class="container mx-auto px-4 mb-12">
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

    @include('layouts.footer')

</main>
@endsection
