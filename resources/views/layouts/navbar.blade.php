<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CINOIR')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #3b82f6;
            transition: width 0.3s;
        }
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
    
        <style>
        @keyframes gradient-x {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-gradient-x {
            animation: gradient-x 6s ease infinite;
        }

        .bg-animated {
            background-size: 300% 300%;
        }
    </style>

    <script src="//unpkg.com/alpinejs" defer></script>
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    


</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    {{-- Navbar --}}
    <header class="bg-gray-800 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-film text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">CINOIR</h1>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}" class="nav-link hover:text-blue-400">Home</a>
                <a href="{{ route('films.index') }}" class="nav-link hover:text-blue-400">Films</a>
                <a href="{{ route('cinemas.index') }}" class="nav-link hover:text-blue-400">Cinemas</a>
                <a href="#contact" class="nav-link hover:text-blue-400">Contact Us</a>
            </nav>

<!-- Navbar Right -->
<div x-data="{ open: false }" class="flex items-center space-x-4">

    {{-- Select City (Dropdown with Alpine.js) --}}
    <div class="relative" x-data="{ cityOpen: false }">
        <button @click="cityOpen = !cityOpen"
            class="flex items-center space-x-1 text-white font-bold hover:text-blue-400 transition">
            <i class="fas fa-map-marker-alt text-blue-400"></i>
            <span>{{ request('kota') ?? 'Select City' }}</span>
            <i class="fas fa-chevron-down ml-1 text-sm"></i>
        </button>

        <!-- Dropdown -->
        <div x-show="cityOpen" @click.away="cityOpen = false"
            class="absolute mt-2 w-40 bg-white text-black rounded-lg shadow-lg z-50">
            <form method="GET" action="{{ route('films.index') }}" class="flex flex-col">
                <button type="submit" name="kota" value=""
                    class="px-4 py-2 text-left hover:bg-blue-100 {{ request('kota') == '' ? 'font-semibold' : '' }}">
                    All Cities
                </button>
                <button type="submit" name="kota" value="Bandung"
                    class="px-4 py-2 text-left hover:bg-blue-100 {{ request('kota') == 'Bandung' ? 'font-semibold' : '' }}">
                    Bandung
                </button>
                <button type="submit" name="kota" value="Jakarta"
                    class="px-4 py-2 text-left hover:bg-blue-100 {{ request('kota') == 'Jakarta' ? 'font-semibold' : '' }}">
                    Jakarta
                </button>
            </form>
        </div>
    </div>

{{-- Search Bar Live --}}
<div 
    x-data="searchMovies()" 
    class="relative w-64"
>
    <input 
        type="text" 
        x-model="query" 
        @input.debounce.300ms="search"
        @focus="search"
        placeholder="Search movies..." 
        class="w-full bg-white/10 text-white placeholder-white/60 px-4 py-2 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"
    />

    <div 
        x-show="results.length > 0" 
        class="absolute mt-2 w-full bg-white rounded-md shadow-lg z-50 max-h-60 overflow-y-auto"
    >
        <template x-for="movie in results" :key="movie.id">
            <a 
                :href="'/films/' + movie.id"
                class="block px-4 py-2 text-sm text-gray-800 hover:bg-blue-100 transition"
                x-text="movie.judul" 
            ></a>
        </template>
    </div>
</div>




</div>




                <!-- Mobile menu button -->
                <button class="md:hidden text-xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    {{-- Konten halaman --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    
    
</body>

<script>
    function searchMovies() {
        return {
            query: '',
            results: [],
            search() {
                if (this.query.length < 1) {
                    this.results = [];
                    return;
                }

                fetch(`/search-movies?query=${this.query}`)
                    .then(res => res.json())
                    .then(data => {
                        this.results = data;
                    });
            }
        }
    }
</script>


<script>
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function () {
        const query = this.value;

        if (query.length === 0) {
            searchResults.classList.add('hidden');
            searchResults.innerHTML = '';
            return;
        }

        fetch(`/search-movies?query=${query}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = '';

                if (data.length === 0) {
                    searchResults.classList.add('hidden');
                    return;
                }

                data.forEach(movie => {
                    const li = document.createElement('li');
                    li.textContent = movie.judul; // 🟢 pakai 'judul' sesuai model
                    li.className = 'px-4 py-2 hover:bg-gray-200 cursor-pointer';
                    li.addEventListener('click', () => {
                        searchInput.value = movie.judul; // 🟢 juga di sini
                        searchResults.classList.add('hidden');
                        // Optional: Redirect ke halaman detail, misalnya:
                        // window.location.href = `/films/${movie.id}`;
                    });
                    searchResults.appendChild(li);
                });

                searchResults.classList.remove('hidden');
            });
    });

    // Sembunyikan dropdown saat klik di luar
    document.addEventListener('click', function (e) {
        if (!searchResults.contains(e.target) && e.target !== searchInput) {
            searchResults.classList.add('hidden');
        }
    });
</script>

@stack('scripts')



</html>

