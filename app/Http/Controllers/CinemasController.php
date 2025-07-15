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
}
