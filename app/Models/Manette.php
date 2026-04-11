<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manette extends Model
{
    protected $fillable = [
        'serial_number',
        'status',
    ];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
}
