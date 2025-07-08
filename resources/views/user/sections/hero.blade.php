<section class="relative overflow-hidden">
    <div class="slide-container flex transition-transform duration-500">
        <!-- Slide 1 -->
        <div class="slide min-w-full relative">
            <div class="bg-gradient-to-r from-gray-900 to-transparent absolute inset-0 z-10"></div>
            <img src="https://source.unsplash.com/random/1600x600/?movie,action" alt="Movie Banner" class="w-full h-auto md:h-[500px] object-cover">
            <div class="absolute bottom-20 left-10 z-20 max-w-md">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">The New Blockbuster</h2>
                <p class="text-gray-300 mb-6">Experience the most anticipated movie of the year in our premium theaters.</p>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-bold pulse-animation">
                    Book Now <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide min-w-full relative hidden">
            <div class="bg-gradient-to-r from-gray-900 to-transparent absolute inset-0 z-10"></div>
            <img src="https://source.unsplash.com/random/1600x600/?movie,scifi" alt="Movie Banner" class="w-full h-auto md:h-[500px] object-cover">
            <div class="absolute bottom-20 left-10 z-20 max-w-md">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Sci-Fi Adventure</h2>
                <p class="text-gray-300 mb-6">Journey to unknown galaxies in this breathtaking cinematic experience.</p>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-bold pulse-animation">
                    Book Now <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Slide Controls -->
    <div class="flex justify-center space-x-4 py-4">
        <button onclick="prevSlide()" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-blue-600 flex items-center justify-center">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button onclick="nextSlide()" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-blue-600 flex items-center justify-center">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>
