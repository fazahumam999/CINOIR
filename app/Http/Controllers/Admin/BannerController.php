<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $banners = Banner::all();
         return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:102400',
    ]);

    if (!$request->hasFile('image') && !$request->hasFile('video')) {
        return back()->withErrors(['message' => 'Harap unggah gambar atau video.']);
    }

    $data = [
        'title' => $request->title,
        'description' => $request->description,
        'image' => null,
        'video' => null,
        'type' => null,
    ];

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('banners', 'public');
        $data['type'] = 'image';
    } elseif ($request->hasFile('video')) {
        $data['video'] = $request->file('video')->store('banners', 'public');
        $data['type'] = 'video';
    }

    Banner::create($data);

    return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
{
    $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:102400',
    ]);

    $data = [
        'title' => $request->title,
        'description' => $request->description,
    ];

    if ($request->hasFile('image')) {
        // Hapus file lama jika ada
        if ($banner->image && \Storage::disk('public')->exists($banner->image)) {
            \Storage::disk('public')->delete($banner->image);
        }

        $data['image'] = $request->file('image')->store('banners', 'public');
        $data['type'] = 'image';

        // Kosongkan video jika sebelumnya ada
        if ($banner->video) {
            $data['video'] = null;
        }
    }

    if ($request->hasFile('video')) {
        if ($banner->video && \Storage::disk('public')->exists($banner->video)) {
            \Storage::disk('public')->delete($banner->video);
        }

        $data['video'] = $request->file('video')->store('banners', 'public');
        $data['type'] = 'video';

        // Kosongkan gambar jika sebelumnya ada
        if ($banner->image) {
            $data['image'] = null;
        }
    }

    $banner->update($data);

    return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
}


    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}