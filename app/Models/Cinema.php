<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'total_kursi'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
