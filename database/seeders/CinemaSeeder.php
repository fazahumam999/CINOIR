<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
        Cinema::insert([
            ['name' => 'Studio 1', 'kota' => 'Kota Bandung', 'image' => 'cinemas/download.jpeg'],
            ['name' => 'Studio 2', 'kota' => 'Kota Bandung', 'image' => 'cinemas/download.jpeg'],
            ['name' => 'Studio 3', 'kota' => 'Kota Bandung', 'image' => 'cinemas/download.jpeg'],
        ]);
    }
}
