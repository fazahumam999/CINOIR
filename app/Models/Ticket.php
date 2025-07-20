<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'nomor_kursi',
        'nama_pembeli',
        'email_pembeli',
        'status'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

        public function movie()
    {
        return $this->hasOneThrough(Movie::class, Schedule::class, 'id', 'id', 'schedule_id', 'movie_id');
    }

    public function cinema()
    {
        return $this->hasOneThrough(Cinema::class, Schedule::class, 'id', 'id', 'schedule_id', 'cinema_id');
    }

    public function seat()
    {
        return $this->hasOne(Seat::class, 'seat_number', 'nomor_kursi')->whereColumn('schedule_id', 'schedule_id');
    }
}
