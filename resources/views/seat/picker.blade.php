@extends('layouts.app')
@section('title', 'Pilih Kursi')

@section('content')
<div class="card p-4">
    <h3 class="mb-4">Pilih Kursi untuk {{ $schedule->movie->judul }} @ {{ $schedule->cinema->name }}</h3>

    <form action="{{ route('seats.reserve', $schedule->id) }}" method="POST">
        @csrf
        <div class="d-flex flex-wrap" style="max-width: 600px;">
        @foreach ($seats as $seat)
    <div class="form-check form-check-inline mb-2">
        <input type="checkbox" class="form-check-input seat-checkbox"
               id="seat-{{ $seat->seat_number }}"
               name="selected_seats[]"
               value="{{ $seat->seat_number }}"
               {{ $seat->status === 'terpesan' ? 'disabled' : '' }}>
        <label class="form-check-label" for="seat-{{ $seat->seat_number }}">{{ $seat->seat_number }}</label>
    </div>
@endforeach

        </div>

        <div class="mt-4">
            <button class="btn btn-success" type="submit">Pesan Kursi</button>
            <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const scheduleId = {{ $schedule_id }};
    const fetchSeatStatus = () => {
        $.ajax({
            url: `/seats/status/${scheduleId}`,
            method: 'GET',
            success: function (data) {
                data.forEach(seat => {
                    const checkbox = $(`#seat-${seat.seat_number}`);
                    if (seat.status === 'terpesan') {
                        checkbox.prop('disabled', true);
                        checkbox.closest('label').addClass('text-danger');
                    } else {
                        checkbox.prop('disabled', false);
                        checkbox.closest('label').removeClass('text-danger');
                    }
                });
            }
        });
    };

    // Panggil pertama kali dan set interval tiap 5 detik
    fetchSeatStatus();
    setInterval(fetchSeatStatus, 5000);
</script>
@endpush

<style>
    .form-check-label.text-danger {
        color: red;
        text-decoration: line-through;
    }
</style>
