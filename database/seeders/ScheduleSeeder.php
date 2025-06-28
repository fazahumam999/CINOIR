<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        Schedule::insert([
            [
                'movie_id' => 1,
                'cinema_id' => 1,
                'waktu_mulai' => now()->addDays(1)->setTime(14, 00),
                'harga' => 50000
            ],
            [
                'movie_id' => 2,
                'cinema_id' => 2,
                'waktu_mulai' => now()->addDays(4)->setTime(16, 30),
                'harga' => 45000
            ]
        ]);
    }
}
