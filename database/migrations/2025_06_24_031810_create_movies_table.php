<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('genre');
            $table->text('sinopsis')->nullable();
            $table->integer('durasi'); //* Hitungannya Menit
            $table->float('rating')->default(0); // ⭐ Tambahan: nilai rating
            $table->string('status')->default('now'); // ⭐ Tambahan: now / coming
            $table->string('poster')->nullable(); // URL atau path ke file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};