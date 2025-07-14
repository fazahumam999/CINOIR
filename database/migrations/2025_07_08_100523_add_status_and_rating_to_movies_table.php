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
    Schema::table('movies', function (Blueprint $table) {
        $table->float('rating')->default(0);
        $table->string('status')->default('now'); // status: now / coming
    });
}

public function down(): void
{
    Schema::table('movies', function (Blueprint $table) {
        $table->dropColumn(['rating', 'status']);
    });
}

};
