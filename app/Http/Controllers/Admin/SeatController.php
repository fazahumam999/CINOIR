<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Schedule;

class SeatController extends Controller
{
    public function showPicker($schedule_id)
    {
        $schedule = Schedule::with(['movie', 'cinema', 'seats'])->findOrFail($schedule_id);
    
        
        if ($schedule->seats->isEmpty()) {
            $rows = ['A', 'B', 'C', 'D', 'E'];
            for ($i = 1; $i <= 10; $i++) {
                foreach ($rows as $row) {
                    Seat::create([
                        'schedule_id' => $schedule_id,
                        'seat_number' => $row.$i,
                        'status' => 'tersedia',
                    ]);
                }
            }
            $schedule->load('seats');
        }
    
        return view('admin.seats.picker', compact('schedule'));
    }
    
    public function reserve(Request $request, $schedule_id)
{
    $request->validate([
        'selected_seats' => 'required|array',
    ]);

    $selectedSeats = $request->selected_seats;

    
    $availableSeats = Seat::where('schedule_id', $schedule_id)
        ->whereIn('seat_number', $selectedSeats)
        ->where('status', 'tersedia')
        ->pluck('seat_number')
        ->toArray();

    
    $unavailable = array_diff($selectedSeats, $availableSeats);

    if (!empty($unavailable)) {
        return back()->with('error', 'Beberapa kursi telah dipesan oleh orang lain: ' . implode(', ', $unavailable));
    }

    
    Seat::where('schedule_id', $schedule_id)
        ->whereIn('seat_number', $availableSeats)
        ->update(['status' => 'terpesan']);

    return redirect()->route('admin.tickets.index')->with('success', 'Kursi berhasil dipesan!');
}

public function seatStatus($schedule_id)
{
    $seats = Seat::where('schedule_id', $schedule_id)
                ->select('seat_number', 'status')
                ->get();

    return response()->json($seats);
}
    
public function index(Schedule $schedule)
{
    $seats = Seat::where('schedule_id', $schedule->id)->get();
    return view('admin.seats.index', compact('schedule', 'seats'));
}

public function book(Request $request)
{
    $request->validate([
        'schedule_id' => 'required|exists:schedules,id',
        'seat_number' => 'required|string',
    ]);

    $existing = Seat::where('schedule_id', $request->schedule_id)
                    ->where('seat_number', $request->seat_number)
                    ->where('status', 'terpesan')
                    ->first();

    if ($existing) {
        return back()->with('error', 'Kursi sudah dipesan!');
    }

    Seat::updateOrCreate(
        ['schedule_id' => $request->schedule_id, 'seat_number' => $request->seat_number],
        ['status' => 'terpesan']
    );

    return redirect()->route('admin.seats.index', $request->schedule_id)->with('success', 'Kursi berhasil dipesan.');
}

}
