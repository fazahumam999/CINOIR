@extends('layouts.navbar')

@section('content')
<main class="bg-gradient-to-b from-white to-blue-100 min-h-screen py-8 px-4">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 mt-40">

        {{-- AREA KURSI --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 flex-1">
            {{-- Legend --}}
            <div class="flex justify-center gap-6 mb-6 text-sm font-medium text-gray-600">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-4 h-4 bg-gray-300 rounded"></span> Available
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-block w-4 h-4 bg-blue-400 rounded"></span> Booked
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-block w-4 h-4 bg-red-500 rounded"></span> Reserved
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-block w-4 h-4 bg-green-500 rounded"></span> Your Seat(s)
                </div>
            </div>

            {{-- Label layar --}}
            <div class="text-center text-gray-700 font-semibold mb-8 tracking-wide uppercase text-sm">Screen</div>

            {{-- Kursi --}}
            <div id="main-seat-grid" class="grid grid-cols-10 gap-3 justify-items-center">
                

                @foreach ($seats as $seat)
                    <button 
                        class="seat w-9 h-9 text-xs font-semibold rounded transition duration-200 ease-in-out
                        @if($seat->status === 'terpesan') bg-red-500 cursor-not-allowed text-white
                        @elseif($seat->status === 'dibayar') bg-blue-400 cursor-not-allowed text-white
                        @else bg-gray-300 hover:bg-green-400 text-gray-800 @endif"
                        @if($seat->status !== 'tersedia') disabled @endif
                        data-seat="{{ $seat->seat_number }}">
                        {{ $seat->seat_number }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- DETAIL FILM --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 w-full md:w-1/3">
            <div class="flex items-start gap-4 mb-6">
                <img src="{{ asset('storage/' . $schedule->movie->poster) }}" class="w-28 h-40 object-cover rounded-lg shadow" alt="{{ $schedule->movie->judul }}">
                <div>
                    <h2 class="text-lg font-bold text-black leading-tight">{{ $schedule->movie->judul }}</h2>

                    {{-- Cinoir Branding --}}
                    <div class="flex items-center text-base text-gray-500 mt-2 font-bold">
                        <svg class="w-5 h-5 mr-2 text-gray" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 4h16v2H4V4zm0 4h16v12H4V8zm5-3h2v2H9V5zm4 0h2v2h-2V5zm4 0h2v2h-2V5z" />
                        </svg>
                        Cinoir
                    </div>

                    {{-- Cinema Name --}}
                    <div class="flex items-center text-sm text-gray-600 mt-1">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2C6.13 2 3 5.13 3 9c0 5.25 7 11 7 11s7-5.75 7-11c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z" />
                        </svg>
                        {{ $schedule->cinema->name }}
                    </div>

                    {{-- Jadwal Tayang --}}
                    <div class="flex items-center text-sm text-gray-600 mt-1">
                        <i class="fa fa-calendar-alt text-gray-400 mr-1"></i>
                        {{ \Carbon\Carbon::parse($schedule->waktu_mulai)->isoFormat('dddd, D MMMM YYYY') }}
                    </div>
                </div>
            </div>

            <hr class="my-4 border-gray-200">

            {{-- Grid Jam Tayang --}}
            <div class="mt-4 mb-4 grid grid-cols-1 bg-gradient-to-r from-blue-200 via-purple-200 to-blue-200 
                        animate-gradient-x bg-[length:300%_300%] rounded-xl p-4 transition">
                <div class="text-center">
                    <p class="text-gray-600 text-sm font-semibold mb-1">Showtime</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('H:i') }} WIB</p>
                </div>
            </div>

            <hr class="border-t border-gray-300 mb-4">

            {{-- Nama --}}
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="nama_pembeli" id="namaPembeli" required
                class="w-full px-4 py-2 bg-white text-gray-800 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

            {{-- Email --}}
            <label class="block text-sm font-medium text-gray-700 mt-4 mb-1">Email</label>
            <input type="email" name="email_pembeli" id="emailPembeli" required
                class="w-full px-4 py-2 bg-white text-gray-800 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

            <hr class="border-t border-gray-300 mb-4 mt-4">

            {{-- Kursi terpilih --}}
            <p class="text-sm text-gray-700 mb-1">Seat(s) : <span id="selected-seat" class="font-semibold text-gray-900">No seat selected</span></p>
            <p class="text-xs text-gray-500" id="seat-count">0 Selected seat(s)</p>

            <div class="flex justify-between items-center border-b border-gray-300 pb-2 mt-1 mb-4">
                <p class="text-sm font-semibold text-gray-800">
                    Total Price: <span id="totalHarga">Rp 0</span>
                </p>
            </div>

            {{-- Tombol --}}
            <div class="mt-6 flex justify-between">
                <button id="reset-btn" type="button" class="border border-gray-400 px-6 py-2 rounded-full text-gray-700 font-semibold hover:bg-gray-400 hover:text-white transition duration-300 ease-in-out">Clear selection</button>
                <form method="POST" action="{{ route('tickets.confirm') }}" id="formConfirm">
                    @csrf
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        <input type="hidden" name="seat" id="seat-input">
                        <input type="hidden" name="nama_pembeli">
                        <input type="hidden" name="email_pembeli">
                    <button id="continueBtn" type="submit"
                        class="bg-black text-white px-8 py-2 rounded-full font-semibold tracking-wide cursor-not-allowed"
                        disabled>
                        Continue
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Modal Overlay -->
<div id="seatVerificationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div id="modalCard" class="relative bg-gray-100 rounded-xl shadow-lg w-[90%] md:w-[400px] p-6 text-gray-800 transform scale-95 opacity-0 transition duration-300 ease-out">
        
        <!-- Header Modal: Tombol X + Garis + Judul -->
        <div class="flex items-center mb-4 space-x-3">
            <!-- Tombol Close -->
            <button onclick="goBack()" 
                class="w-10 h-10 flex items-center justify-center text-gray-500 bg-white/10 backdrop-blur-md hover:bg-white/20 rounded-full transition text-2xl font-bold">
                &times;
            </button>

            <!-- Garis Vertikal -->
            <div class="w-px h-6 bg-gray-400"></div>

            <!-- Judul Modal -->
            <h2 class="text-base md:text-lg font-semibold" style="color: #525252ff;">How many seats needed?</h2>
        </div>

        <!-- Info Film -->
        <div class="text-center mb-4">
            <h3 class="text-xl font-bold text-gray-800 uppercase">{{ $schedule->movie->judul }}</h3>
            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('d M Y, H:i') }}</p>
        </div>

        <!-- Informasi tambahan -->
        <ul class="text-sm text-red-700 mb-4 list-disc pl-5">
            <li>Purchased tickets are non-refundable or exchangeable.</li>
            <li>Tickets are required for children aged 2 and above.</li>
        </ul>

        <!-- Jam Tayang -->
        <div class="bg-white border p-2 rounded mb-4 text-center text-sm font-medium">
            {{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('H:i') }}
        </div>

        <!-- Counter Jumlah Kursi -->
        <div class="flex items-center justify-center space-x-4 mb-4">
            <button onclick="decreaseSeat()" class="bg-gray-300 w-8 h-8 rounded-full text-xl">-</button>
            <span id="seatCount" class="text-lg font-bold">1</span>
            <button onclick="increaseSeat()" class="bg-gray-300 w-8 h-8 rounded-full text-xl">+</button>
        </div>

        <!-- Tombol Lanjut -->
        <button onclick="closeModal()" class="bg-black text-white w-full py-2 rounded-full font-semibold">Continue</button>
    </div>
</div>

<!-- Toast Notification (Centered, animated) -->
<div id="seatLimitToast" class="fixed inset-0 flex items-center justify-center z-50 pointer-events-none">
    <div class="bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg text-lg opacity-0 scale-95 transition-all duration-300" id="toastContent">
        You can only select <span id="maxSeatText">1</span> seat(s).
    </div>
</div>

<div 
    x-data="{
        selectedSeats: [],
        maxSeats: 1,
        showModal: false,
        toggleSeat(seatNumber) {
            if (this.selectedSeats.includes(seatNumber)) {
                // Unselect jika sudah dipilih
                this.selectedSeats = this.selectedSeats.filter(s => s !== seatNumber);
            } else if (this.selectedSeats.length >= this.maxSeats) {
                // Tampilkan modal jika melebihi
                this.showModal = true;
            } else {
                // Tambahkan seat ke daftar
                this.selectedSeats.push(seatNumber);
            }
        }
    }"
>
    <!-- MODAL PERINGATAN -->
    <div 
        x-show="showModal"
        x-cloak
        x-transition
        @click.away="showModal = false"
        class="fixed inset-0 z-50 bg-black bg-opacity-60 flex justify-center items-center"
    >
        <div class="bg-gray-900 text-white p-6 rounded-xl text-center max-w-sm w-full">
            <div class="flex justify-center mb-4">
                <div class="bg-yellow-500 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-semibold mb-2">Wait, you picked too many seats</h2>
            <p class="text-sm text-gray-300 mb-4">You can only pick <span x-text="maxSeats"></span> seat(s) at a time.</p>
            <button 
                @click="showModal = false"
                class="bg-white text-black rounded-full px-5 py-1 font-semibold hover:bg-gray-200"
            >
                Got it
            </button>
        </div>
    </div>
</div>


<!-- Simpan harga di elemen HTML -->
<span id="ticketPrice" data-price="{{ $schedule->harga }}"></span>

@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>⚠️ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<script>
    let seatCount = @json($seatCount ?? 1);
    let selectedSeats = [];

    document.addEventListener('DOMContentLoaded', () => {
        const seatButtons = document.querySelectorAll('button[data-seat]');
        const selectedSeatDisplay = document.getElementById('selected-seat');
        const seatCountDisplay = document.getElementById('seat-count');
        const seatInput = document.getElementById('seat-input');
        const resetBtn = document.getElementById('reset-btn');
        const continueBtn = document.getElementById('continueBtn');
        const namaInput = document.getElementById('namaPembeli');
        const emailInput = document.getElementById('emailPembeli');
        const form = document.getElementById('formConfirm');
        

        // Update tampilan kursi yang dipilih
        function updateSeatDisplay() {
            seatInput.value = selectedSeats.join(',');
            selectedSeatDisplay.innerText = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'No seat selected';
            seatCountDisplay.innerText = `${selectedSeats.length} Selected seat(s)`;

            const ticketPrice = parseInt(document.getElementById('ticketPrice').dataset.price);
            const totalHarga = selectedSeats.length * ticketPrice;
            document.getElementById('totalHarga').textContent = `Rp ${totalHarga.toLocaleString('id-ID')}`;
        }

        // Cek validitas form input
        function checkFormValidity() {
            const nama = namaInput.value.trim();
            const email = emailInput.value.trim();
            const seatSelected = selectedSeats.length > 0;

            if (nama && email && seatSelected) {
                continueBtn.disabled = false;
                continueBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
                continueBtn.classList.add('bg-black', 'hover:bg-black', 'cursor-pointer');
            } else {
                continueBtn.disabled = true;
                continueBtn.classList.add('bg-gray-300', 'cursor-not-allowed');
                continueBtn.classList.remove('bg-black', 'hover:bg-black', 'cursor-pointer');
            }
        }

        // Inisialisasi tombol saat halaman dimuat
        checkFormValidity();

        // Event untuk memilih atau membatalkan kursi
        seatButtons.forEach(button => {
            button.addEventListener('click', () => {
                const seat = button.dataset.seat;

                if (selectedSeats.includes(seat)) {
                    selectedSeats = selectedSeats.filter(s => s !== seat);
                    button.classList.remove('bg-green-400', 'text-white');
                    button.classList.add('bg-gray-300', 'text-gray-800');
                } else {
                    if (selectedSeats.length >= seatCount) {
                        showSeatLimitToast(seatCount);
                        return;
                    }
                    selectedSeats.push(seat);
                    button.classList.remove('bg-gray-300', 'text-gray-800');
                    button.classList.add('bg-green-400', 'text-white');
                }

                updateSeatDisplay();
                checkFormValidity();
            });
        });

        // Event input nama dan email
        namaInput.addEventListener('input', checkFormValidity);
        emailInput.addEventListener('input', checkFormValidity);

        // Event reset kursi
        resetBtn.addEventListener('click', () => {
            selectedSeats = [];
            seatButtons.forEach(btn => {
                btn.classList.remove('bg-green-400', 'text-white');
                btn.classList.add('bg-gray-300', 'text-gray-800');
            });
            updateSeatDisplay();
            checkFormValidity();
        });
    });

    // Tampilkan notifikasi jika melebihi batas seat
    function showSeatLimitToast(max) {
        const toast = document.getElementById('seatLimitToast');
        const content = document.getElementById('toastContent');
        document.getElementById('maxSeatText').textContent = max;

        toast.classList.remove('pointer-events-none');
        content.classList.remove('opacity-0', 'scale-95');
        content.classList.add('opacity-100', 'scale-100');

        setTimeout(() => {
            content.classList.remove('opacity-100', 'scale-100');
            content.classList.add('opacity-0', 'scale-95');
            toast.classList.add('pointer-events-none');
        }, 2000);
    }

    // Modal untuk memilih jumlah kursi
    function openModal() {
        const modal = document.getElementById('seatVerificationModal');
        const card = document.getElementById('modalCard');
        modal.classList.remove('hidden');
        setTimeout(() => {
            card.classList.remove('opacity-0', 'scale-95');
            card.classList.add('opacity-100', 'scale-100');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('seatVerificationModal');
        const card = document.getElementById('modalCard');
        card.classList.remove('opacity-100', 'scale-100');
        card.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Jalankan modal saat halaman dibuka
    window.onload = openModal;

    // Tombol tambah dan kurang jumlah seat
    function decreaseSeat() {
        if (seatCount > 1) {
            seatCount--;
            document.getElementById('seatCount').textContent = seatCount;
        }
    }

    function increaseSeat() {
        seatCount++;
        document.getElementById('seatCount').textContent = seatCount;
    }

    function goBack() {
        window.history.back();
    }

    // Salin input nama dan email ke hidden input saat submit form
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('formConfirm');
        if (form) {
            form.addEventListener('submit', function (e) {
                const namaVisible = document.getElementById('namaPembeli').value;
                const emailVisible = document.getElementById('emailPembeli').value;

                form.querySelector('input[name="nama_pembeli"]').value = namaVisible;
                form.querySelector('input[name="email_pembeli"]').value = emailVisible;
            });
        }
    });
</script>



@endsection