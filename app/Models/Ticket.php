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
}
