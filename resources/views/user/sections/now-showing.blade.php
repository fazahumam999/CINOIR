<section class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold mb-8 flex items-center">
        <span class="bg-blue-600 w-2 h-8 mr-3"></span>
        Now Showing
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($films as $film)
    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
        <div class="relative">
            <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" class="w-full h-64 md:h-80 object-cover">
            <div class="absolute top-2 right-2 flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white font-bold rating-circle">
                {{ $film->rating }}
            </div>
        </div>
        <div class="p-4">
            <h3 class="font-bold text-lg mb-1">{{ $film->judul }}</h3>
            <div class="flex items-center text-gray-400 text-sm mb-3">
                <span>{{ $film->genre }}</span>
                <span class="mx-2">•</span>
                <span>{{ $film->durasi }} Menit</span>
            </div>
            <a href="{{ route('cinemas.index') }}" class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Times & Tickets
            </a>
        </div>
    </div>
@endforeach

    </div>
</section>
