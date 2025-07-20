<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::insert([
            // [
            //     'title' => 'Jurassic World : Rebirth', 
            //     'description' => 'Buy tickets now!', 
            //     'image' => 'banners/jurassic.jpg',
            //     'video' => null,
            //     'type' => 'image',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'title' => 'Save with Family', 
            //     'description' => 'Head to your local and SAVE* at the movies today!', 
            //     'image' => 'banners/savewithfamily.jpg',
            //     'video' => null,
            //     'type' => 'image',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'title' => 'Fantastic Four : First Step', 
            //     'description' => 'Advance Screening', 
            //     'image' => 'banners/seeitfirst.jpg',
            //     'video' => null,
            //     'type' => 'image',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'title' => 'F1 The Movie', 
            //     'description' => 'Strap in, as the high-octane, action-packed F1 The Movie is now showing at Event Cinemas and your position on the grid is waiting.', 
            //     'image' => 'banners/upgrade.jpg',
            //     'video' => null,
            //     'type' => 'image',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);

    }
}
