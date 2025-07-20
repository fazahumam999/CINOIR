@extends('layouts.navbar')

@section('content')
<main class="min-h-screen bg-black flex items-center justify-center p-6 text-white">
    <div class="bg-gray-800 p-10 rounded-xl shadow-lg text-center max-w-md">
        <h1 class="text-3xl font-bold mb-4 text-green-400">Payment Successful ✅</h1>
        <p class="text-lg mb-2">Thank you for your payment.</p>
        @if(session('order_number'))
            <p class="text-sm text-gray-300">Order Number:</p>
            <p class="text-xl font-mono font-bold text-yellow-400 mb-4">
                #{{ session('order_number') }}
            </p>
        @endif
        <a href="{{ route('cinemas.index') }}"
           class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
           Go to Dashboard
        </a>
    </div>
</main>
@endsection
