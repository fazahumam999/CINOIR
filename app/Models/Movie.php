<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'genre',
        'sinopsis',
        'durasi',
        'rating',
        'status',
        'poster',
        'trailer_url',
        'harga',
    ];


    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
