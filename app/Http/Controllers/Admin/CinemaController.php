<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'kota' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cinemas', 'public');
        }

        Cinema::create([
            'name' => $request->name,
            'kota' => $request->kota,
            'image' => $imagePath,
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
            'kota' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'kota' => $request->kota,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($cinema->image && Storage::disk('public')->exists($cinema->image)) {
                Storage::disk('public')->delete($cinema->image);
            }
            $data['image'] = $request->file('image')->store('cinemas', 'public');
        }

        $cinema->update($data);

        return redirect()->route('admin.cinemas.index')->with('success', 'Bioskop berhasil diperbarui.');
    }

    public function destroy(Cinema $cinema)
    {
        if ($cinema->image && Storage::disk('public')->exists($cinema->image)) {
            Storage::disk('public')->delete($cinema->image);
        }

        $cinema->delete();

        return redirect()->route('admin.cinemas.index')->with('success', 'Bioskop berhasil dihapus.');
    }
}
