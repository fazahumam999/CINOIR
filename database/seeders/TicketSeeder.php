<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        Ticket::insert([
            // [
            //     'schedule_id' => 1,
            //     'nomor_kursi' => 'A1',
            //     'nama_pembeli' => 'John Doe',
            //     'email_pembeli' => 'john@example.com',
            //     'status' => 'dibayar'
            // ],
            // [
            //     'schedule_id' => 1,
            //     'nomor_kursi' => 'A2',
            //     'nama_pembeli' => 'Jane Smith',
            //     'email_pembeli' => 'jane@example.com',
            //     'status' => 'terpesan'
            // ]
        ]);
    }
}
