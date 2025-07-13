<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class FilmController extends Controller
{
    
    public function index()
{
    $nowShowing = Movie::where('status', 'now')->latest()->get();
    $comingSoon = Movie::where('status', 'soon')->latest()->get();

    return view('user.films.index', compact('nowShowing', 'comingSoon'));
}

}
