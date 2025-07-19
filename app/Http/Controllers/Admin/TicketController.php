<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    
    public function index()
    {
        $tickets = Ticket::with('schedule.movie')->get();
        return view('tickets.index', compact('tickets'));
    }

    
    public function create()
    {
        $schedules = Schedule::with('movie', 'cinema')->get();
        return view('tickets.create', compact('schedules'));
    }



public function store(Request $request)
{
    
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

    
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    
    foreach ($request->nomor_kursi as $kursi) {
        Ticket::create([
            'schedule_id' => $request->schedule_id,
            'nomor_kursi' => $kursi,
            'nama_pembeli' => $request->nama_pembeli,
            'email_pembeli' => $request->email_pembeli,
            'status' => $request->status,
        ]);
    }

    return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil dipesan.');
}


    
    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    
    public function edit(Ticket $ticket)
    {
        $schedules = Schedule::with('movie', 'cinema')->get();
        return view('tickets.edit', compact('ticket', 'schedules'));
    }

    
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

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil dihapus.');
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

public function confirm(Request $request)
{
    $request->validate([
        'seat' => 'required',
        'schedule_id' => 'required|exists:schedules,id',
        'nama_pembeli' => 'required|string|max:100',
        'email_pembeli' => 'required|email',
    ]);

    $selectedSeats = explode(',', $request->seat);

    foreach ($selectedSeats as $seat) {
        Ticket::create([
            'schedule_id' => $request->schedule_id,
            'nomor_kursi' => $seat,
            'nama_pembeli' => $request->nama_pembeli,
            'email_pembeli' => $request->email_pembeli,
            'status' => 'terpesan', 
        ]);
    }

    return redirect()->route('user.tickets.payment')->with('success', 'Tiket berhasil dipesan!');
}



}