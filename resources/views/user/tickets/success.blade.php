@extends('layouts.navbar')

@section('content')

@php
    $tickets = session('tickets') ?? [];
    $ticketCount = count($tickets);
    $hargaPerTiket = $tickets[0]->schedule->harga ?? 0;
    $totalPrice = $ticketCount * $hargaPerTiket;
@endphp

<main class="min-h-screen flex items-center justify-center p-6 text-white animated-gradient">
    <div class="bg-white rounded-xl shadow-xl text-center max-w-lg w-full p-10 animate-fade-in-up text-gray-800">
        
        {{-- Animated Check Icon --}}
        <div class="flex justify-center mb-6">
            <svg class="w-16 h-16 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                <path class="animate-pop" stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4 -4" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-green-600 mb-4">Payment Successful</h1>

        <div class="border-t border-dashed border-gray-400 my-4"></div>

        <div class="text-left text-sm mb-6 space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-500">Payment type:</span>
                <span class="font-semibold">Credit Card</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Email:</span>
                @php
                    $email = $tickets[0]->email_pembeli ?? (auth()->user()->email ?? 'guest@example.com');
                @endphp
                <span class="font-medium">{{ $email }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Amount Paid:</span>
                <span class="font-bold text-lg text-black">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
            </div>
            @if(session('order_number'))
                <div class="flex justify-between">
                    <span class="text-gray-500">Order Number:</span>
                    <span class="text-yellow-600 font-semibold">#{{ session('order_number') }}</span>
                </div>
            @endif
            <div class="flex justify-between">
                <span class="text-gray-500">Transaction ID:</span>
                <span class="text-gray-600">TRX{{ rand(100000, 999999) }}</span>
            </div>
        </div>

        <div class="flex justify-center gap-4">
            <button onclick="window.print()"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                PRINT
            </button>
            <a href="{{ route('cinemas.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-lg shadow">
                BACK TO CINEMA
            </a>
        </div>
    </div>
</main>

@push('styles')
<style>
    .animated-gradient {
        background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #fbc2eb, #a6c1ee);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.5s ease-out forwards;
        will-change: transform, opacity;
    }

    .animate-pop {
        animation: pop 0.5s ease-out forwards;
        will-change: transform, opacity;
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pop {
        0% {
            transform: scale(0.3);
            opacity: 0;
        }
        80% {
            transform: scale(1.1);
            opacity: 1;
        }
        100% {
            transform: scale(1);
        }
    }
</style>
@endpush

@endsection
