<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;

    // Disesuaikan dengan data yang digunakan sekarang
    protected $fillable = ['name', 'kota', 'image'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
