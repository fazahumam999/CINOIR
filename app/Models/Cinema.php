<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'total_auditoriums','kota', 'experience', 'image'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
