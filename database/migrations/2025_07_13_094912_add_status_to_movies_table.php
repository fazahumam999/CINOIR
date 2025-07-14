<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('movies', function (Blueprint $table) {
        $table->enum('status', ['now_showing', 'coming_soon'])->default('now_showing')->after('durasi');
    });
}
public function down()
{
    Schema::table('movies', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
