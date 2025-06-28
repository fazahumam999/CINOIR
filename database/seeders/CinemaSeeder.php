<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
        Cinema::insert([
            ['nama' => 'Studio 1', 'total_kursi' => 40],
            ['nama' => 'Studio 2', 'total_kursi' => 50],
            ['nama' => 'Studio 3', 'total_kursi' => 60],
        ]);
    }
}
