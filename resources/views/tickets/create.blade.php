@extends('layouts.app')

@section('title', 'Pesan Tiket')

@section('content')
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/dashboard" class="text-warning">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-warning">Tiket</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Pesan</li>
        </ol>
    </nav>
</div>

<div class="card mx-auto p-4" style="max-width: 700px;">
    <h2 class="mb-4">Pesan Tiket</h2>

    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Jadwal</label>
            <select name="schedule_id" id="schedule_id" class="form-select" required>
                <option value="">-- Pilih Jadwal --</option>
                @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}">
                        {{ $schedule->movie->judul }} - {{ $schedule->cinema->name }} ({{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('d M Y H:i') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Kursi</label>
            <div id="seat-picker" class="d-flex flex-wrap gap-2">
                <small class="text-muted">Silakan pilih jadwal terlebih dahulu</small>
            </div>
            <div id="nomor_kursi_inputs"></div>
            <div class="form-text">🟩 = Tersedia, 🟥 = Terisi, 🟨 = Dipilih</div>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Pembeli</label>
            <input type="email" name="email_pembeli" class="form-control" required>
        </div>
        

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="terpesan">Terpesan</option>
                <option value="dibayar">Dibayar</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
        </div>

        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Simpan
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const seatPicker = document.getElementById('seat-picker');
    const seatInputsContainer = document.getElementById('nomor_kursi_inputs');
    let selectedSeats = [];

    function renderSeats(bookedSeats = []) {
        seatPicker.innerHTML = '';
        seatInputsContainer.innerHTML = '';
        selectedSeats = [];

        const rows = ['A', 'B', 'C', 'D', 'E'];
        const seatsPerRow = 10;

        rows.forEach(row => {
            for (let i = 1; i <= seatsPerRow; i++) {
                const seatId = row + i;
                const btn = document.createElement('button');
                btn.textContent = seatId;
                btn.type = 'button';
                btn.className = 'btn btn-sm me-1 mb-1 ' +
                    (bookedSeats.includes(seatId) ? 'btn-danger disabled' : 'btn-outline-success');

                btn.onclick = () => {
                    if (btn.classList.contains('disabled')) return;

                    if (btn.classList.contains('btn-warning')) {
                        btn.classList.remove('btn-warning');
                        btn.classList.add('btn-outline-success');
                        selectedSeats = selectedSeats.filter(seat => seat !== seatId);
                    } else {
                        btn.classList.remove('btn-outline-success');
                        btn.classList.add('btn-warning');
                        selectedSeats.push(seatId);
                    }

                    // Update hidden inputs
                    seatInputsContainer.innerHTML = '';
                    selectedSeats.forEach(seat => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'nomor_kursi[]';
                        input.value = seat;
                        seatInputsContainer.appendChild(input);
                    });
                };

                seatPicker.appendChild(btn);
            }
        });
    }

    document.getElementById('schedule_id').addEventListener('change', function () {
        const scheduleId = this.value;
        if (!scheduleId) {
            seatPicker.innerHTML = '<small class="text-muted">Silakan pilih jadwal terlebih dahulu</small>';
            return;
        }

        fetch(`/get-seats/${scheduleId}`)
            .then(response => response.json())
            .then(data => {
                renderSeats(data);
            });
    });
</script>
@endpush
