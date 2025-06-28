<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    // Simpan tiket baru
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'nomor_kursi' => [
                'required',
                Rule::unique('tickets')->where(function ($query) use ($request) {
                    return $query->where('schedule_id', $request->schedule_id);
                }),
            ],
            'nama_pembeli' => 'required|string',
            'email_pembeli' => 'required|email',
            'status' => 'required|in:terpesan,dibayar,dibatalkan',
        ]);

        Ticket::create($request->all());

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
    $bookedSeats = Ticket::where('schedule_id', $schedule_id)->pluck('nomor_kursi');
    return response()->json($bookedSeats);
}

}
