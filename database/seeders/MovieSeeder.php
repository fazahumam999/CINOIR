<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        Movie::insert([
            // [
            //     'judul' => 'Jurassic World Rebirth',
            //     'genre' => 'Action/Adventure,  Sci-Fi/Fantasy',
            //     'sinopsis' => 'Five years after the events of Jurassic World Dominion, the planet\'s ecology has proven largely inhospitable to dinosaurs. Those remaining exist in isolated equatorial environments with climates resembling the one in which they once thrived. The three most colossal creatures within that tropical biosphere hold the key to a drug that will bring miraculous life-saving benefits to humankind.',
            //     'durasi' => 130,
            //     'rating' => 7,
            //     'status' => 'now',
            //     'poster' => 'posters/jurassic.jpeg',
            // ],
            // [
            //     'judul' => 'Superman',
            //     'genre' => 'Action/Adventure,  Sci-Fi/Fantasy',
            //     'sinopsis' => '“Superman,” DC Studios\' first feature film, is set to blast into theaters worldwide this July from Warner Bros. Pictures. In his signature style, James Gunn takes on this original superhero in the new DC Universe, with a unique blend of epic action, humor, and heart, presenting a Superman driven by compassion and an innate belief in the good of humanity.',
            //     'durasi' => 129,
            //     'rating' => 9.3,
            //     'status' => 'soon',
            //     'poster' => 'posters/superman.jpg',
            // ],
        ]);
    }
}