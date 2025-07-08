<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Cinema;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    
    public function index()
    {
        $schedules = Schedule::with(['movie', 'cinema'])->get();
        return view('schedules.index', compact('schedules'));
    }

    
    public function create()
    {
        $movies = Movie::all();
        $cinemas = Cinema::all();
        return view('schedules.create', compact('movies', 'cinemas'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cinema_id' => 'required|exists:cinemas,id',
            'waktu_mulai' => 'required|date',
            'harga' => 'required|numeric|min:0',
        ]);

        Schedule::create($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    
    public function show(Schedule $schedule)
    {
        return view('admin.schedules.show', compact('schedule'));
    }

    
    public function edit(Schedule $schedule)
    {
        $movies = Movie::all();
        $cinemas = Cinema::all();
        return view('schedules.edit', compact('schedule', 'movies', 'cinemas'));
    }

    
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cinema_id' => 'required|exists:cinemas,id',
            'waktu_mulai' => 'required|date',
            'harga' => 'required|numeric|min:0',
        ]);

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
