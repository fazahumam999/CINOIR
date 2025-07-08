<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $films = Movie::where('status', 'now')->get();
        $banners = Banner::all();
        return view('user.home', compact('films','banners'));
    }

}
