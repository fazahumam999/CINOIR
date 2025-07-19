<?php

namespace Database\Seeders;

use App\Models\Seat;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh menambahkan 10 seat untuk schedule ID 1
        foreach (range(1, 10) as $i) {
            Seat::create([
                'schedule_id' => 2,
                'seat_number' => 'A' . $i,
                'status' => 'tersedia'
            ]);
        }
    }
}
