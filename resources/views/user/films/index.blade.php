@extends('layouts.navbar')

@section('title', 'Now Showing')

@section('content')
<main class="bg-gradient-to-b from-black to-gray-900 min-h-screen py-8 px-4 text-white">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6 relative">
            {{-- Toggle Tabs --}}
            <div class="text-xl font-semibold tracking-wide flex gap-10">
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

            {{-- Sort Dropdown --}}
            <form method="GET" action="{{ url()->current() }}" class="text-sm text-white absolute right-0 top-0">
                <label for="sort" class="mr-2 font-semibold">Sort by:</label>
                <div class="relative inline-block w-52">
                    <select name="sort" id="sort" onchange="this.form.submit()"
                        class="block appearance-none w-full bg-gray-800 border border-gray-600 text-white py-2 pl-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <option value="">Default</option>
                        <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>Judul A–Z</option>
                        <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Judul Z–A</option>
                        <option value="durasi_asc" {{ request('sort') == 'durasi_asc' ? 'selected' : '' }}>Durasi Pendek–Panjang</option>
                        <option value="durasi_desc" {{ request('sort') == 'durasi_desc' ? 'selected' : '' }}>Durasi Panjang–Pendek</option>
                    </select>
                    {{-- Custom Arrow --}}
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path d="M5.516 7.548a.625.625 0 01.884 0L10 11.148l3.6-3.6a.625.625 0 01.884.884l-4.042 4.042a.625.625 0 01-.884 0L5.516 8.432a.625.625 0 010-.884z"/>
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        @php
    function getYoutubeId($url) {
        if (preg_match('/youtu\.be\/([^\?]+)/', $url, $matches)) {
            return $matches[1];
        } elseif (preg_match('/v=([^&]+)/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
@endphp

<div x-data="{ showTrailer: false, trailerId: null }">


        {{-- Grid Film --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse($nowShowing as $movie)
            <div class="relative group rounded-lg overflow-hidden shadow-lg transition transform hover:scale-105">
                {{-- Poster --}}
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->judul }}" class="w-full h-96 object-cover">

<div class="absolute top-2 left-2 px-2 py-1 rounded-full font-semibold text-[10px] text-white shadow-sm transition-all duration-700"
     data-rating="{{ $movie->rating }}"
     style="background-color: #16a34a;"> <!-- default hijau -->
    <span class="animated-rating">10.0</span>
</div>




@php
    $videoId = getYoutubeId($movie->trailer_url);
@endphp

{{-- Hover Buttons --}}
<div class="absolute inset-0 bg-black bg-opacity-60 opacity-0 group-hover:opacity-100 transition flex flex-col justify-center items-center space-y-3">
        <button @click="showTrailer = true; trailerId = '{{ getYoutubeId($movie->trailer_url) }}'"
            class="px-4 py-2 border border-white text-white rounded-full text-sm hover:bg-white hover:text-black transition">
            See Trailer
        </button>
        <a href="{{ route('user.films.show', $movie->id) }}"
            class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm hover:bg-blue-600 transition">
            Times & Ticket
        </a>
    </div>


                {{-- Info Film --}}
                <div class="p-3 bg-white text-black">
                    <h3 class="font-semibold text-sm uppercase truncate">{{ $movie->judul }}</h3>
                    <div class="flex items-center gap-2 text-xs mt-1">
                        <span class="bg-gray-200 text-gray-800 px-2 py-0.5 rounded">2D</span>
                        <span class="bg-yellow-400 text-black px-2 py-0.5 rounded">SU</span>
                        <span class="text-gray-600">{{ floor($movie->durasi / 60) }}h {{ $movie->durasi % 60 }}m</span>
                    </div>
                </div>
            </div>

            
            @empty
            <p class="col-span-full text-center text-gray-400">Tidak ada film ditemukan.</p>
            @endforelse

            <!-- Modal Trailer Global -->
<div x-show="showTrailer" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80">
    <div class="relative bg-black rounded-lg shadow-lg w-[90vw] max-w-4xl">
        <div class="relative w-full pt-[56.25%]">
            <iframe x-ref="youtubePlayer"
            class="absolute top-0 left-0 w-full h-full rounded-lg"
                :src="'https://www.youtube.com/embed/' + trailerId + '?autoplay=1'"
                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
            </iframe>
        </div>
         <button
            @click="
                showTrailer = false;
                $refs.youtubePlayer.src = '';
                setTimeout(() => {
                    $refs.youtubePlayer.src = 'https://www.youtube.com/embed/' + trailerId;
                }, 200);
            "
            class="absolute -top-4 -right-4 bg-white text-black w-10 h-10 rounded-full text-2xl font-bold flex items-center justify-center hover:bg-red-600 hover:text-white transition">
            &times;
        </button>
    </div>
</div>

        </div>
    </div>
</main>

<script>
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            document.querySelectorAll('[x-data]').forEach(el => {
                const scope = Alpine?.$data?.(el);
                if (scope?.showTrailer) scope.showTrailer = false;
            });
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ratings = document.querySelectorAll('[data-rating]');

        ratings.forEach(el => {
            const target = parseFloat(el.dataset.rating);
            const textSpan = el.querySelector('.animated-rating');
            let current = 10.0;
            const step = 0.05;

            const getColor = (val) => {
                // Gradient dari hijau → kuning → oranye → merah
                if (val >= 8) return '#16a34a';       // green
                if (val >= 6) return '#eab308';       // yellow
                if (val >= 4) return '#f97316';       // orange
                return '#dc2626';                     // red
            };

            const interval = setInterval(() => {
                current = Math.max(current - step, target);
                textSpan.textContent = current.toFixed(1);

                // Gradual color transition
                el.style.backgroundColor = getColor(current);

                if (current <= target) {
                    clearInterval(interval);
                }
            }, 30);
        });
    });
</script>


@endsection
