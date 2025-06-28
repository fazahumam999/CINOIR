@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama:</label><br>
        <input type="text" name="name" value="{{ $user->name }}"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ $user->email }}"><br><br>

        <label>Password (kosongkan jika tidak diubah):</label><br>
        <input type="password" name="password"><br><br>

        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <button type="submit">Update</button>
    </form>
@endsection
