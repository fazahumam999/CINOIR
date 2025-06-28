@extends('layouts.app')
@section('title', 'Pilih Kursi')

@section('content')
<div class="card p-4">
    <h3 class="mb-4">Pilih Kursi untuk {{ $schedule->movie->judul }} @ {{ $schedule->cinema->name }}</h3>

    <form action="{{ route('seats.reserve', $schedule->id) }}" method="POST">
        @csrf
        <div class="d-flex flex-wrap" style="max-width: 600px;">
            @foreach ($schedule->seats as $seat)
                <label class="m-2">
                    <input type="checkbox" name="selected_seats[]" value="{{ $seat->seat_number }}"
                        {{ $seat->status === 'terpesan' ? 'disabled' : '' }}>
                    <span class="badge bg-{{ $seat->status === 'terpesan' ? 'secondary' : 'success' }}">
                        {{ $seat->seat_number }}
                    </span>
                </label>
            @endforeach
        </div>

        <div class="mt-4">
            <button class="btn btn-success" type="submit">Pesan Kursi</button>
            <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
