<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemasController extends Controller
{
    public function index()
    {
        $cinemas = Cinema::all();
        return view('user.cinemas.index', compact('cinemas'));
    }
    
}
