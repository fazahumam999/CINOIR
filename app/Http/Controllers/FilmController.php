<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query();

        // Filtering berdasarkan dropdown "sort by"
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'judul_asc':
                    $query->orderBy('judul', 'asc');
                    break;
                case 'judul_desc':
                    $query->orderBy('judul', 'desc');
                    break;
                case 'durasi_asc':
                    $query->orderBy('durasi', 'asc');
                    break;
                case 'durasi_desc':
                    $query->orderBy('durasi', 'desc');
                    break;
            }
        }

        // Ambil berdasarkan status film
        $nowShowing = (clone $query)->where('status', 'now')->get();
        $comingSoon = (clone $query)->where('status', 'soon')->get();

        return view('user.films.index', compact('nowShowing', 'comingSoon'));
    }

    public function nowShowing(Request $request)
    {
        $query = Movie::where('status', 'now');

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'judul_asc':
                    $query->orderBy('judul', 'asc');
                    break;
                case 'judul_desc':
                    $query->orderBy('judul', 'desc');
                    break;
                case 'durasi_asc':
                    $query->orderBy('durasi', 'asc');
                    break;
                case 'durasi_desc':
                    $query->orderBy('durasi', 'desc');
                    break;
            }
        }

        $movies = $query->get();

        return view('user.films.now-showing', compact('movies'));
    }

    public function comingSoon(Request $request)
    {
        $query = Movie::where('status', 'soon');

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'judul_asc':
                    $query->orderBy('judul', 'asc');
                    break;
                case 'judul_desc':
                    $query->orderBy('judul', 'desc');
                    break;
                case 'durasi_asc':
                    $query->orderBy('durasi', 'asc');
                    break;
                case 'durasi_desc':
                    $query->orderBy('durasi', 'desc');
                    break;
            }
        }

        $movies = $query->get();

        return view('user.films.coming-soon', compact('movies'));
    }

    public function show($id)
{
    $movie = Movie::findOrFail($id);
    return view('user.films.show', compact('movie'));
}

}



