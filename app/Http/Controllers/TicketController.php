<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    // Tampilkan semua tiket
    public function index()
    {
        $tickets = Ticket::with('schedule')->get();
        return view('tickets.index', compact('tickets'));
    }

    // Tampilkan form untuk membuat tiket
    public function create()
    {
        $schedules = Schedule::with('movie', 'cinema')->get();
        return view('tickets.create', compact('schedules'));
    }



public function store(Request $request)
{
    // Validasi array nomor_kursi dan isi lainnya
    $validator = Validator::make($request->all(), [
        'schedule_id' => 'required|exists:schedules,id',
        'nomor_kursi' => 'required|array|min:1',
        'nomor_kursi.*' => [
            'required',
            'string',
            Rule::unique('tickets', 'nomor_kursi')->where(function ($query) use ($request) {
                return $query->where('schedule_id', $request->schedule_id);
            }),
        ],
        'nama_pembeli' => 'required|string|max:255',
        'email_pembeli' => 'required|email|max:255',
        'status' => 'required|in:terpesan,dibayar,dibatalkan',
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Simpan tiket satu per satu untuk tiap kursi
    foreach ($request->nomor_kursi as $kursi) {
        Ticket::create([
            'schedule_id' => $request->schedule_id,
            'nomor_kursi' => $kursi,
            'nama_pembeli' => $request->nama_pembeli,
            'email_pembeli' => $request->email_pembeli,
            'status' => $request->status,
        ]);
    }

    return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dipesan.');
}


    // Tampilkan detail tiket
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    // Tampilkan form edit tiket
    public function edit(Ticket $ticket)
    {
        $schedules = Schedule::with('movie', 'cinema')->get();
        return view('tickets.edit', compact('ticket', 'schedules'));
    }

    // Update tiket
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'nomor_kursi' => 'required|string|max:10',
            'nama_pembeli' => 'required|string|max:100',
            'email_pembeli' => 'required|email',
            'status' => 'required|in:terpesan,dibayar,dibatalkan',
        ]);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    // Hapus tiket
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }

    public function getSeats($schedule_id)
{
    $schedule = Schedule::findOrFail($schedule_id);
    $bookedSeats = Ticket::where('schedule_id', $schedule_id)->pluck('nomor_kursi');
    return response()->json([
        'booked' => $bookedSeats,
        'harga' => $schedule->harga
    ]);
}


}