<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use Illuminate\Support\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $tanggalMulai = Carbon::create(2025, 7, 16); // 16 Juli 2025
        $tanggalSelesai = Carbon::create(2025, 7, 22); // 22 Juli 2025

        $jamTayangUmum = [12, 14, 16, 18, 20, 21];
        $hargaList = [45000, 50000, 55000, 60000];

        $cinemaCount = 6;
        $movieCount = 12;

        $movieIds = range(1, $movieCount);
        shuffle($movieIds); // acak untuk distribusi adil

        foreach (range(1, $cinemaCount) as $cinemaId) {
            $filmYangDitayangkan = array_slice($movieIds, ($cinemaId - 1) * 2, 3); // tiap cinema 3 film

            foreach ($filmYangDitayangkan as $movieId) {
                // Loop tanggal 16–22 Juli
                for ($date = $tanggalMulai->copy(); $date->lte($tanggalSelesai); $date->addDay()) {
                    $jumlahJamTayang = rand(4, 5); // tiap hari 4–5 jam tayang

                    $jamTayangHariIni = collect($jamTayangUmum)->shuffle()->take($jumlahJamTayang);

                    foreach ($jamTayangHariIni as $jam) {
                        $waktu_mulai = $date->copy()->setTime($jam, 0);

                        Schedule::create([
                            'movie_id'    => $movieId,
                            'cinema_id'   => $cinemaId,
                            'waktu_mulai' => $waktu_mulai,
                            'harga'       => $hargaList[array_rand($hargaList)],
                        ]);
                    }
                }
            }
        }
    }
}