<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    
    public function index()
    {
        $cinemas = Cinema::all();
        return view('cinemas.index', compact('cinemas'));
    }

    
    public function create()
    {
        return view('cinemas.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_kursi' => 'required|integer',
        ]);

        Cinema::create([
            'name' => $request->name,
            'total_kursi' => $request->total_kursi,
        ]);

        return redirect()->route('admin.cinemas.index')->with('success', 'Bioskop berhasil ditambahkan.');
    }

    
    public function show(Cinema $cinema)
    {
        return view('cinemas.show', compact('cinema'));
    }

    
    public function edit(Cinema $cinema)
    {
        return view('cinemas.edit', compact('cinema'));
    }

    
    public function update(Request $request, Cinema $cinema)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_kursi' => 'required|integer',
        ]);

       $cinema->update([
        'name' => $request->name,
        'total_kursi' => $request->total_kursi,
    ]);


        return redirect()->route('admin.cinemas.index')->with('success', 'Bioskop berhasil diperbarui.');
    }

    
    public function destroy(Cinema $cinema)
    {
        $cinema->delete();

        return redirect()->route('admin.cinemas.index')->with('success', 'Bioskop berhasil dihapus.');
    }
}
