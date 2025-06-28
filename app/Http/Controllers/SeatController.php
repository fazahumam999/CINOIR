<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function showPicker($schedule_id)
    {
        $schedule = Schedule::with(['movie', 'cinema', 'seats'])->findOrFail($schedule_id);
    
        // Jika belum ada kursi, generate default (contoh: 5 baris x 10 kolom)
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
    
        return view('seats.picker', compact('schedule'));
    }
    
    public function reserve(Request $request, $schedule_id)
    {
        $request->validate([
            'selected_seats' => 'required|array',
        ]);
    
        foreach ($request->selected_seats as $seatNumber) {
            Seat::where('schedule_id', $schedule_id)
                ->where('seat_number', $seatNumber)
                ->where('status', 'tersedia')
                ->update(['status' => 'terpesan']);
        }
    
        return redirect()->route('tickets.index')->with('success', 'Kursi berhasil dipesan!');
    }
    
}
