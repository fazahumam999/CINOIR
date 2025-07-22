<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Ticket;
use App\Models\Seat;
use App\Models\Order;

class TicketsController extends Controller
{
    public function selectSeat($id)
    {
        $schedule = Schedule::with('movie', 'cinema')->findOrFail($id);
        $seats = Seat::where('schedule_id', $id)->get();

            if ($seats->isEmpty()) {
        $rows = ['A', 'B', 'C', 'D', 'E'];
        for ($i = 1; $i <= 10; $i++) {
            foreach ($rows as $row) {
                Seat::create([
                    'schedule_id' => $id,
                    'seat_number' => $row.$i,
                    'status' => 'tersedia',
                ]);
            }
        }

                $seats = Seat::where('schedule_id', $id)->get();
    }

    $seats = Seat::where('schedule_id', $id)->get()->sortBy('seat_number', SORT_NATURAL);

    
        return view('user.tickets.select-seat', compact('schedule', 'seats'));
    }

    public function getSeats($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $booked = $schedule->tickets()->pluck('nomor_kursi');

        return response()->json([
            'booked' => $booked,
            'harga' => $schedule->harga,
        ]);
    }


public function confirm(Request $request)
{
    $request->validate([
        'schedule_id' => 'required|exists:schedules,id',
        'seat' => 'required|string',
        'nama_pembeli' => 'required|string|max:255',
        'email_pembeli' => 'required|email|max:255',
    ]);

    $seats = explode(',', $request->seat); // misal: ['A1', 'A2', 'A3']

    $tickets = [];

    foreach ($seats as $seat) {
        $tickets[] = Ticket::create([
            'schedule_id' => $request->schedule_id,
            'nomor_kursi' => $seat,
            'nama_pembeli' => $request->nama_pembeli,
            'email_pembeli' => $request->email_pembeli,
        ]);
    }

    // ✅ Update semua kursi yang dipilih
    Seat::where('schedule_id', $request->schedule_id)
        ->whereIn('seat_number', $seats)
        ->update(['status' => 'terpesan']);

    session(['tickets' => $tickets]);

    return redirect()->route('user.tickets.payment', ['id' => $tickets[0]->id]);
}


public function cancel(Request $request)
{
    $tickets = session('tickets', []);

    foreach ($tickets as $ticket) {
        // Hapus tiket dari database
        $ticketModel = Ticket::find($ticket->id); // <- pastikan ini model asli
        if ($ticketModel) {
            $ticketModel->delete();
        }

        // Ambil seat yang sesuai
        $seat = Seat::where('schedule_id', $ticket->schedule_id)
                    ->where('seat_number', $ticket->nomor_kursi)
                    ->first();

        if ($seat) {
            $seat->status = 'tersedia'; 
            $seat->save();
        }
    }

    session()->forget('tickets');

    return response()->json(['message' => 'Tickets cancelled and seats released.']);
}



public function store(Request $request)
{
    $request->validate([
        'schedule_id' => 'required|exists:schedules,id',
        'seats' => 'required|array|min:1',
        'seats.*' => 'string',
        'nama_pembeli' => 'required|string|max:255',
        'email_pembeli' => 'required|email|max:255',
    ]);

    foreach ($request->seats as $seat) {
        Ticket::create([
            'schedule_id' => $request->schedule_id,
            'nomor_kursi' => $seat,
            'nama_pembeli' => $request->nama_pembeli,
            'email_pembeli' => $request->email_pembeli,
            'status' => 'terpesan',
        ]);

        Seat::where('schedule_id', $request->schedule_id)
            ->where('seat_number', $seat)
            ->update(['status' => 'terpesan']);
    }

    // Buat Order
    $order = Order::create([
        'schedule_id' => $request->schedule_id,
        'nama_pembeli' => $request->nama_pembeli,
        'email_pembeli' => $request->email_pembeli,
        'jumlah_tiket' => count($request->seats),
        'total_harga' => count($request->seats) * Schedule::find($request->schedule_id)->harga,
    ]);

    return redirect()->route('user.tickets.payment', ['id' => $order->id]);
}



public function payment($id)
{
    // Ambil tiket beserta relasi schedule dan movie
    $ticket = Ticket::with('schedule.movie')->findOrFail($id);

    // Kirim ke view
    return view('user.tickets.payment', compact('ticket'));
}


public function completePayment(Request $request)
{
    $request->validate([
        'ticket_id' => 'required|exists:tickets,id',
    ]);

    $ticket = Ticket::findOrFail($request->ticket_id);

    // Ambil semua tiket dengan email dan schedule yang sama
    $tickets = Ticket::where('schedule_id', $ticket->schedule_id)
        ->where('email_pembeli', $ticket->email_pembeli)
        ->get();

    foreach ($tickets as $t) {
        $t->status = 'dibayar';
        $t->save();

        // Update juga status kursi
        Seat::where('schedule_id', $t->schedule_id)
            ->where('seat_number', $t->nomor_kursi)
            ->update(['status' => 'dibayar']);
    }

    // Generate nomor pesanan
    $orderNumber = 'ORD' . now()->format('YmdHis') . rand(100, 999);
    session()->flash('order_number', $orderNumber);

    return redirect()->route('user.tickets.success');
}




}
