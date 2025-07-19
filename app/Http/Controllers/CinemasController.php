<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemasController extends Controller
{
public function index(Request $request)
{
    // builder dasar
    $query = Cinema::select('*');

    // Filter kota jika dropdown diisi
    if ($request->filled('kota')) {
        $query->where('kota', $request->kota);
    }

    $cinemas = $query->get();

    return view('user.cinemas.index', [
        'cinemas'  => $cinemas,
        'selected' => $request->kota,
    ]);
}

public function show(Request $request, Cinema $cinema)
{
    // Tanggal yang dipilih (default = hari ini)
    $date = $request->query('date', today()->toDateString());

    // Ambil semua jadwal hari itu untuk bioskop ini, beserta film‑nya
    $schedules = $cinema->schedules()
                        ->with('movie')
                        ->whereDate('waktu_mulai', $date)
                        ->orderBy('waktu_mulai')
                        ->get()
                        ->groupBy('movie_id');   // dikelompokkan per film

    // Siapkan 7 tab tanggal (hari ini + 6 hari ke depan)
    $tabs = collect(range(0,6))->map(fn($i) => today()->addDays($i));

    return view('user.cinemas.show', [
        'cinema'    => $cinema,
        'schedules' => $schedules,
        'date'      => $date,
        'tabs'      => $tabs,
    ]);
}


}
