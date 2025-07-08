@extends('layouts.app')

@section('content')
    <h1>Tambah User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="name"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <button type="submit">Simpan</button>
    </form>
@endsection
