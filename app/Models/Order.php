<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
        protected $fillable = [
        'nama_pembeli',
        'email_pembeli',
        'schedule_id',
        'nomor_kursi',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
