<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Console extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'daily_price',
        'ability',
        'image',
        'promo_price',
        'promo_starts_at',
        'promo_ends_at',
        'promo_active',
    ];

    protected $casts = [
        'daily_price' => 'decimal:2',
        'promo_price' => 'decimal:2',
        'promo_starts_at' => 'date',
        'promo_ends_at' => 'date',
        'promo_active' => 'boolean',
        'ability' => 'boolean',
    ];

    protected $appends = [
        'effective_daily_price',
        'has_active_promo',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isPromoActiveForDate(?Carbon $date = null): bool
    {
        $date = ($date ?? now())->copy()->startOfDay();

        if (! $this->promo_active || $this->promo_price === null) {
            return false;
        }

        if ($this->promo_starts_at && $date->lt($this->promo_starts_at->copy()->startOfDay())) {
            return false;
        }

        if ($this->promo_ends_at && $date->gt($this->promo_ends_at->copy()->endOfDay())) {
            return false;
        }

        return true;
    }

    public function effectiveDailyPriceForDate(?Carbon $date = null): float
    {
        return $this->isPromoActiveForDate($date)
            ? (float) $this->promo_price
            : (float) $this->daily_price;
    }

    public function getEffectiveDailyPriceAttribute(): float
    {
        return $this->effectiveDailyPriceForDate();
    }

    public function getHasActivePromoAttribute(): bool
    {
        return $this->isPromoActiveForDate();
    }
}
