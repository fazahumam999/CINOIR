@extends('layouts.app')

@section('content')
    <h1>Detail User</h1>

    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('users.index') }}">← Kembali ke daftar</a>
@endsection
