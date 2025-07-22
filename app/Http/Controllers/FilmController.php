<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Cinema;

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

    $dates = Schedule::selectRaw('DATE(waktu_mulai) as date')
        ->where('movie_id', $movie->id)
        ->distinct()
        ->orderBy('date')
        ->get();

    return view('user.films.show', compact('movie', 'dates'));
}


public function search(Request $request)
{
    $query = $request->get('query');

    $movies = Movie::where('judul', 'like', '%' . $query . '%')
        ->select('id', 'judul')
        ->limit(5)
        ->get();

    return response()->json($movies);
}

public function getCinemas(Request $request)
{
    $movieId = $request->movie_id;
    $date = $request->date;

    $cinemas = Cinema::whereHas('schedules', function ($query) use ($movieId, $date) {
        $query->where('movie_id', $movieId)
              ->whereDate('start_time', $date);
    })->get();

    return response()->json($cinemas);
}

public function getSchedules(Request $request)
{
    $movieId = $request->movie_id;
    $cinemaId = $request->cinema_id;
    $date = $request->date;

    $schedules = Schedule::where('movie_id', $movieId)
        ->where('cinema_id', $cinemaId)
        ->whereDate('start_time', $date)
        ->get();

    return response()->json($schedules);
}




}



