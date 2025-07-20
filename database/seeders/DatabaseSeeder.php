<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BannerSeeder::class,
            CinemaSeeder::class,
            MovieSeeder::class,
            ScheduleSeeder::class,
            TicketSeeder::class,
            SeatSeeder::class, // opsional jika ada seat
        ]);
    }
}
