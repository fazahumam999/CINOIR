@extends('layouts.app')

@section('title', 'Edit Bioskop')

@section('content')
    <div class="card mx-auto p-4" style="max-width: 600px;">
        <h2 class="mb-4">Edit Bioskop</h2>

        <form action="{{ route('admin.cinemas.update', $cinema->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Bioskop</label>
                <input type="text" name="name" class="form-control" value="{{ $cinema->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Auditoriums</label>
                <input type="number" name="total_kursi" class="form-control" value="{{ $cinema->total_kursi }}" required>
            </div>

            <div class="mb-3">
    <label class="form-label">Foto Bioskop</label>
    <input type="file" name="photo" class="form-control" accept="image/*">
    @if ($cinema->photo)
        <img src="{{ asset('storage/' . $cinema->photo) }}" alt="Foto Bioskop" class="img-fluid mt-2" style="max-height: 150px;">
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Kota</label>
    <input type="number" name="studio_count" class="form-control" value="{{ $cinema->studio_count }}" min="1">
</div>

<div class="mb-3">
    <label class="form-label">Experience</label><br>
    @php
        $experiences = ['IMAX', '4DX', 'Real3D', 'Dolby Atmos', 'Regular', 'SweetBox'];
        $selectedExperiences = json_decode($cinema->experiences ?? '[]');
    @endphp
    @foreach ($experiences as $exp)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="experiences[]" value="{{ $exp }}"
                {{ in_array($exp, $selectedExperiences) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $exp }}</label>
        </div>
    @endforeach
</div>


            <a href="{{ route('admin.cinemas.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
