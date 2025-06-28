<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Cinema;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    // Tampilkan semua jadwal
    public function index()
    {
        $schedules = Schedule::with(['movie', 'cinema'])->get();
        return view('schedules.index', compact('schedules'));
    }

    // Tampilkan form tambah jadwal
    public function create()
    {
        $movies = Movie::all();
        $cinemas = Cinema::all();
        return view('schedules.create', compact('movies', 'cinemas'));
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cinema_id' => 'required|exists:cinemas,id',
            'waktu_mulai' => 'required|date',
            'harga' => 'required|numeric|min:0',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Tampilkan detail jadwal
    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    // Tampilkan form edit jadwal
    public function edit(Schedule $schedule)
    {
        $movies = Movie::all();
        $cinemas = Cinema::all();
        return view('schedules.edit', compact('schedule', 'movies', 'cinemas'));
    }

    // Update data jadwal
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cinema_id' => 'required|exists:cinemas,id',
            'waktu_mulai' => 'required|date',
            'harga' => 'required|numeric|min:0',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    // Hapus jadwal
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
