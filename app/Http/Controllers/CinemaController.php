<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    // Tampilkan semua bioskop
    public function index()
    {
        $cinemas = Cinema::all();
        return view('cinemas.index', compact('cinemas'));
    }

    // Tampilkan form untuk membuat bioskop baru
    public function create()
    {
        return view('cinemas.create');
    }

    // Simpan data bioskop baru
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

        return redirect()->route('cinemas.index')->with('success', 'Bioskop berhasil ditambahkan.');
    }

    // Tampilkan detail satu bioskop
    public function show(Cinema $cinema)
    {
        return view('cinemas.show', compact('cinema'));
    }

    // Tampilkan form edit
    public function edit(Cinema $cinema)
    {
        return view('cinemas.edit', compact('cinema'));
    }

    // Update data bioskop
    public function update(Request $request, Cinema $cinema)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'total_kursi' => 'required|integer',
        ]);

        $cinema->update($request->all());

        return redirect()->route('cinemas.index')->with('success', 'Bioskop berhasil diperbarui.');
    }

    // Hapus bioskop
    public function destroy(Cinema $cinema)
    {
        $cinema->delete();

        return redirect()->route('cinemas.index')->with('success', 'Bioskop berhasil dihapus.');
    }
}
