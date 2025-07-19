@extends('layouts.navbar')

@section('content')
<main class="bg-gray-900 text-white min-h-screen pt-0">

    {{-- Hero Banner --}}
    <div class="w-full">
        <img src="{{ asset('storage/images/banner-illust.jpg') }}" alt="Banner Cinemas"
            class="w-full h-[300px] object-cover">
    </div>

    <div class="container mx-auto px-4 py-10">

        {{-- Dropdown Filter Kota --}}
        <form method="GET" action="{{ route('cinemas.index') }}" class="relative z-10 flex justify-center mb-12">
            <div class="bg-white rounded-full shadow-lg flex items-center px-4 py-2 space-x-4 w-full max-w-2xl">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 12.414M6.343 6.343a8 8 0 0111.314 11.314M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                    </path>
                </svg>
                <select name="kota" onchange="this.form.submit()" class="flex-1 bg-transparent text-black focus:outline-none">
                    <option value="">All Cities</option>
                    <option value="Bandung" {{ request('kota') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                    <option value="Jakarta" {{ request('kota') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                </select>
                <button type="submit" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition duration-200">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M13.293 14.707a1 1 0 001.414-1.414l-3.829-3.829A5 5 0 1115 10a5 5 0 01-1.707 3.707l3.829 3.829a1 1 0 01-1.414 1.414l-3.829-3.829zM10 14a4 4 0 100-8 4 4 0 000 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </form>

        {{-- Judul --}}
        <h2 class="text-3xl font-bold mb-6">Our Cinemas</h2>

        {{-- Grid List Cinemas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($cinemas as $cinema)
<a href="{{ route('cinemas.show', $cinema) }}" class="block hover:shadow-xl transition-shadow duration-300">
    <div class="bg-white rounded-lg overflow-hidden shadow text-black">
        @if ($cinema->image)
            <img src="{{ asset('storage/' . $cinema->image) }}" alt="{{ $cinema->name }}" class="w-full h-56 object-cover">
        @endif
        <div class="p-4">
            <h2 class="text-xl font-bold">{{ $cinema->name }}</h2>
            <p class="text-sm text-gray-600">{{ $cinema->kota ?? '-' }}</p>
        </div>
    </div>
</a>

            @endforeach
        </div>
    </div>
</main>

 @include('layouts.footer')

@endsection
