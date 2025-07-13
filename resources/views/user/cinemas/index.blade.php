@extends('layouts.navbar')

@section('content')
<main class="bg-gray-900 text-white min-h-screen pt-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Our Cinemas</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($cinemas as $cinema)
                <div class="bg-white rounded-lg overflow-hidden shadow text-black">
                    @if ($cinema->image)
                        <img src="{{ asset('storage/' . $cinema->image) }}" alt="{{ $cinema->name }}" class="w-full h-56 object-cover">
                    @endif
                    <div class="p-4">
                        <h2 class="text-xl font-bold">{{ $cinema->name }}</h2>
                        <p class="text-sm text-gray-600">{{ $cinema->location }}</p>
                        <p class="mt-2 text-gray-700">{{ $cinema->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
