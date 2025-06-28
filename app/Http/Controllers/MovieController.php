<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Tampilkan semua film
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    // Tampilkan form tambah film
    public function create()
    {
        return view('movies.create');
    }

    // Simpan film baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'sinopsis' => 'required|string',
            'durasi' => 'required|integer|min:1',
        ]);

        Movie::create([
            'judul' => $request->judul,
            'genre' => $request->genre,
            'sinopsis' => $request->sinopsis,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('movies.index')->with('success', 'Film berhasil ditambahkan.');
    }

    // Tampilkan detail film tertentu
    public function show(Movie $movie)
    {
        // Sertakan jadwal film jika diperlukan
        $schedules = $movie->schedules;
        return view('movies.show', compact('movie', 'schedules'));
    }

    // Tampilkan form edit film
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    // Update data film
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'sinopsis' => 'required|string',
            'durasi' => 'required|integer|min:1',
        ]);

        $movie->update($request->all());

        return redirect()->route('movies.index')->with('success', 'Film berhasil diperbarui.');
    }

    // Hapus film
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Film berhasil dihapus.');
    }
}
