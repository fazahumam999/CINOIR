<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        Movie::insert([
            [
                'judul' => 'Avengers: Endgame',
                'genre' => 'Action',
                'sinopsis' => 'Superhero movie about time travel and Thanos.',
                'durasi' => 181
            ],
            [
                'title' => 'Inside Out 2',
                'genre' => 'Animation',
                'sinopsis' => 'Animated journey inside the mind of a teenager.',
                'durasi' => 95
            ]
        ]);
    }
}
