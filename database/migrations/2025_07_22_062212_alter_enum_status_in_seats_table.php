<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends \Illuminate\Database\Migrations\Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE seats MODIFY COLUMN status ENUM('tersedia', 'terpesan', 'dibayar') DEFAULT 'tersedia'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE seats MODIFY COLUMN status ENUM('tersedia', 'terpesan') DEFAULT 'tersedia'");
    }
};
