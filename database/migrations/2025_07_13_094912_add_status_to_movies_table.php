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
        if (!Schema::hasColumn('movies', 'status')) {
            $table->enum('status', ['now_showing', 'coming_soon'])->default('now_showing')->after('durasi');
        }

        if (!Schema::hasColumn('movies', 'rating')) {
            $table->float('rating')->default(0)->after('status');
        }
    });
}
public function down()
{
    Schema::table('movies', function (Blueprint $table) {
        if (Schema::hasColumn('movies', 'status')) {
            $table->dropColumn('status');
        }

        if (Schema::hasColumn('movies', 'rating')) {
            $table->dropColumn('rating');
        }
    });
}
};
