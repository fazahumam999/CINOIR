@extends('layouts.navbar')

@section('content')
<main class="bg-gradient-to-b from-black to-gray-900 min-h-screen text-white p-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Payment Methods --}}
        <div class="bg-gray-800 rounded-xl p-6 shadow-lg">
            <div class="mb-4">
                <h2 class="text-xl font-bold">Order confirmation</h2>
                <p class="text-yellow-400">Complete payment in <span id="countdown">00:10</span></p>
                <p class="text-sm text-gray-400">Let’s finish your payment so we can process your order.</p>
            </div>

            <div class="space-y-4">
                <h3 class="font-semibold text-lg">Select payment method</h3>
                <div class="space-y-2">
                    <label class="flex items-center p-4 bg-gray-700 rounded-lg cursor-pointer">
                        <input type="radio" name="payment_method" class="form-radio mr-3">
                        <div>
                            <p class="font-semibold">NoirPAY</p>
                            <p class="text-sm text-gray-400">Balance: Rp0</p>
                        </div>
                    </label>

                    <label class="flex items-center p-4 bg-gray-700 rounded-lg cursor-pointer">
                        <input type="radio" name="payment_method" class="form-radio mr-3">
                        <p class="font-semibold">Bank Virtual Account</p>
                    </label>

                    <label class="flex items-center p-4 bg-gray-700 rounded-lg cursor-pointer">
                        <input type="radio" name="payment_method" class="form-radio mr-3">
                        <p class="font-semibold">Credit Card / Debit Card</p>
                    </label>
                </div>
            </div>
        </div>

        {{-- Order Details --}}
        <div class="bg-gray-800 rounded-xl p-6 shadow-lg">
            <h3 class="font-semibold text-lg mb-4">Order details</h3>
            <div class="flex items-center gap-4 mb-4">
                <img src="{{ asset('storage/' . $ticket->schedule->movie->poster) }}" alt="Poster" class="w-24 rounded-lg">
                <div>
    <p class="font-bold text-2xl mb-2">{{ $ticket->schedule->movie->judul }}</p>

    {{-- Logo bioskop --}}
    <p class="text-sm text-gray-400 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10v6a2 2 0 002 2h12a2 2 0 002-2v-6m-16 0V7a2 2 0 012-2h12a2 2 0 012 2v3M4 15h16" />
</svg>

        {{ $ticket->schedule->cinema->name }}, Studio {{ $ticket->schedule->studio }}, {{ $ticket->schedule->experience }}
    </p>

    {{-- Jadwal Tayang --}}
    <p class="text-sm text-gray-400 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />
        </svg>
        {{ \Carbon\Carbon::parse($ticket->schedule->tanggal_tayang)->format('D, d M Y') }}, {{ $ticket->schedule->jam }}
    </p>

    {{-- Showtime --}}
    <p class="text-sm text-gray-400 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <circle cx="12" cy="12" r="10" />
            <polyline points="12 6 12 12 16 14" />
        </svg>
        {{ \Carbon\Carbon::parse($ticket->schedule->waktu_mulai)->format('H:i') }} WIB
    </p>
</div>

            </div>

           


@php
    $tickets = session('tickets');
    $jumlahTiket = count($tickets);
    $hargaSatuan = $tickets[0]->schedule->harga;
    $total = $jumlahTiket * $hargaSatuan;
@endphp

    {{-- Tampilkan nomor kursi yang dipilih --}}
    <div class="text-sm text-gray-400">
        Seats:
        @foreach ($tickets as $t)
            <span class="inline-block bg-gray-700 text-white rounded px-2 py-1 mx-1 mb-4">{{ $t->nomor_kursi }}</span>
        @endforeach
    </div>

<div class="border-t border-gray-600 pt-4 space-y-2">
    <div class="flex justify-between">
        <p>Tickets ({{ $jumlahTiket }}x)</p>
        <p>Rp{{ number_format($hargaSatuan, 0, ',', '.') }}</p>
    </div>

    <div class="flex justify-between font-bold mt-2">
        <p>Total payment</p>
        <p>Rp{{ number_format($total, 0, ',', '.') }}</p>
    </div>

    <form method="POST" action="{{ route('user.tickets.completePayment') }}">
    @csrf
    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

    <button type="submit" class="w-full mt-4 bg-gray-500 text-white py-3 rounded-full font-semibold hover:bg-blue-500 transition">
        Pay Rp{{ number_format($total, 0, ',', '.') }}
    </button>
</form>

</div>


        </div>
    </div>

    <!-- Modal Expired -->
<div id="expiredModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white text-center rounded-xl p-8 max-w-sm w-full shadow-xl animate-fade-in-up text-gray-800">
        <div class="flex justify-center mb-4">
            <!-- Icon jam/expired -->
            <svg class="w-14 h-14 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l2.5 2.5M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
        </div>
        <h2 class="text-lg font-semibold text-red-600 mb-2">Oops! Your payment time has expired</h2>
        <p class="text-sm text-gray-600 mb-6">Your tickets have been automatically cancelled.</p>
        <a href="{{ route('cinemas.index') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full shadow">
            Back to Cinema
        </a>
    </div>
</div>

@push('scripts')
<script>
    let duration = 10; // 10 minutes
    const countdownEl = document.getElementById('countdown');

    const timer = setInterval(() => {
        const minutes = Math.floor(duration / 60).toString().padStart(2, '0');
        const seconds = (duration % 60).toString().padStart(2, '0');
        countdownEl.textContent = `${minutes}:${seconds}`;

        if (duration <= 0) {
            clearInterval(timer);

            // Kirim pembatalan ke server
            fetch("{{ route('tickets.cancel') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then(() => {
                // Tampilkan modal
                document.getElementById('expiredModal').classList.remove('hidden');
            });
        }

        duration--;
    }, 1000);
</script>
@endpush

@push('styles')
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.3s ease-out forwards;
    }
</style>
@endpush


</main>


@endsection
