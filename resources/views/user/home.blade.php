<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinoir - Premium Cinema Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .pulse-animation:hover {
            animation: pulse 0.5s ease-in-out;
        }
        .slide {
            transition: transform 0.5s ease;
        }
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
        .ticket-btn:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }
        .ticket-btn {
            transition: all 0.3s ease;
        }
        .rating-circle {
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">
    @include('layouts.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        <section class="relative overflow-hidden">
            <div class="slide-container flex transition-transform duration-500 overflow-hidden">
                @foreach ($banners as $banner)
                    <div class="slide min-w-full relative">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="w-full h-[500px] object-cover">
                        <div class="absolute bottom-20 left-10 z-20 max-w-md">
                            <h2 class="text-4xl font-bold mb-4">{{ $banner->title }}</h2>
                            <p class="text-gray-300 mb-6">{{ $banner->description }}</p>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-bold pulse-animation">
                                Book Now <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center space-x-4 py-4">
                <button onclick="prevSlide()" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-blue-600 flex items-center justify-center">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button onclick="nextSlide()" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-blue-600 flex items-center justify-center">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>
        @include('user.sections.now-showing')
    </main>

    @include('layouts.footer')

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = i === index ? 'block' : 'none';
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSlide(0);
            setInterval(nextSlide, 5000);
        });
    </script>
</body>
</html>
