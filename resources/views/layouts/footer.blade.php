<footer id="contact" class="bg-gray-800 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-xl font-bold mb-4 flex items-center">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-film text-white"></i>
                    </div>
                    CINOIR
                </h3>
                <p class="text-gray-400">Premium cinema experience with state-of-the-art technology and luxurious comfort.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-blue-400">Home</a></li>
                    <li><a href="{{ route('films.index') }}" class="text-gray-400 hover:text-blue-400">Movies</a></li>
                    <li><a href="{{ route('cinemas.index') }}" class="text-gray-400 hover:text-blue-400">Cinemas</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-bold mb-4">Contact Us</h3>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-400"></i>
                        123 Kopo, Bandung
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-2 text-blue-400"></i>
                        (+62) 456-7890
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-2 text-blue-400"></i>
                        info@cinoir.com
                    </li>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h3 class="text-lg font-bold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-600">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-600">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-600">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-600">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
                <div class="mt-6">
                    <h4 class="font-bold mb-2">Subscribe to Newsletter</h4>
                    <div class="flex">
                        <input type="email" placeholder="Your email" class="bg-gray-700 text-white px-4 py-2 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-600 w-full">
                        <button class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-r">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-500">
            <p>&copy; 2025 Cinoir Cinemas. All Rights Reserved.</p>
        </div>
    </div>
</footer>
