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
            <a href="#" class="nav-link hover:text-blue-400">Films</a>
            <a href="#" class="nav-link hover:text-blue-400">Cinemas</a>
            <a href="#" class="nav-link hover:text-blue-400">Contact Us</a>
        </nav>

        <!-- Right side icons -->
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-1 cursor-pointer group">
                <span class="text-blue-400"><i class="fas fa-map-marker-alt"></i></span>
                <span class="text-sm font-bold group-hover:text-blue-400">Select Location</span>
            </div>
            <button class="w-8 h-8 flex items-center justify-center hover:text-blue-400">
                <i class="fas fa-search"></i>
            </button>
            <!-- Mobile menu button -->
            <button class="md:hidden text-xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>
