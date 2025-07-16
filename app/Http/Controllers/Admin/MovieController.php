<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    
    public function create()
    {
        return view('movies.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'sinopsis' => 'required|string',
            'durasi' => 'required|integer|min:1',
            'rating' => 'required|numeric',
            'poster' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:now,soon'

        ]);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        Movie::create([
            'judul' => $request->judul,
            'genre' => $request->genre,
            'sinopsis' => $request->sinopsis,
            'durasi' => $request->durasi,
            'rating' => $request->rating,
            'status' => $request->status,
            'poster' => $posterPath,
        ]);

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil ditambahkan.');
    }

    
    public function show(Movie $movie)
    {
        
        $schedules = $movie->schedules;
        return view('admin.movies.show', compact('movie', 'schedules'));
    }

    
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'sinopsis' => 'required|string',
            'durasi' => 'required|integer|min:1',
            'rating' => 'required|numeric',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:now,soon'

            
        ]);

        $data = $request->only(['judul', 'genre', 'sinopsis', 'durasi', 'rating', 'status']);

        if ($request->hasFile('poster')) {
            
            if ($movie->poster && Storage::disk('public')->exists($movie->poster)) {
                Storage::disk('public')->delete($movie->poster);
            }
            
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $movie->update($data);

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil diperbarui.');
        
    }

    
    public function destroy(Movie $movie)
    {
        
        if ($movie->poster && Storage::disk('public')->exists($movie->poster)) {
            Storage::disk('public')->delete($movie->poster);
        }

        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil dihapus.');
    }
}