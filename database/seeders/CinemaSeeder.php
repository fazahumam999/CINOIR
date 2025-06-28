<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
        Cinema::insert([
            ['name' => 'Studio 1', 'total_kursi' => 40],
            ['name' => 'Studio 2', 'total_kursi' => 50],
            ['name' => 'Studio 3', 'total_kursi' => 60],
        ]);
    }
}
