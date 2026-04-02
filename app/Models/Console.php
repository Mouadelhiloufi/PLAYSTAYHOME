<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'daily_price',
        'ability',
        'image',
    ];

    protected $casts = [
        'daily_price' => 'decimal:2',
        'ability' => 'boolean',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
