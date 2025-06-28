@extends('layouts.app')

@section('title', 'Pilih Kursi - ' . $schedule->movie->judul)

@section('content')
    <div class="card p-4">
        <h4 class="mb-4">Pilih Kursi untuk <strong>{{ $schedule->movie->judul }}</strong></h4>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('seats.book') }}" method="POST">
            @csrf
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

            <div class="d-flex flex-wrap gap-2">
                @foreach (range('A', 'E') as $row)
                    @for ($i = 1; $i <= 6; $i++)
                        @php
                            $seatNo = $row . $i;
                            $booked = $seats->where('seat_number', $seatNo)->where('status', 'terpesan')->first();
                        @endphp

                        <button type="submit" name="seat_number" value="{{ $seatNo }}"
                            class="btn btn-sm {{ $booked ? 'btn-secondary' : 'btn-success' }}"
                            {{ $booked ? 'disabled' : '' }}>
                            {{ $seatNo }}
                        </button>
                    @endfor
                @endforeach
            </div>
        </form>
    </div>
@endsection
