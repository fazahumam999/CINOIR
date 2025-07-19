<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
    $table->string('nama_pembeli');
    $table->string('email_pembeli');
    $table->integer('jumlah_kursi');
    $table->integer('total_harga');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
