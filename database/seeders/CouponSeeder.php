<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'value' => 10,
                'expiration_date' => now()->addMonths(3)->format('Y-m-d'),
                'limit' => 100,
                'is_active' => true,
            ],
            [
                'code' => 'SUMMER20',
                'value' => 20,
                'expiration_date' => now()->addMonths(2)->format('Y-m-d'),
                'limit' => 50,
                'is_active' => true,
            ],
            [
                'code' => 'FIXED5',
                'value' => 5,
                'expiration_date' => now()->addMonths(6)->format('Y-m-d'),
                'limit' => 200,
                'is_active' => true,
            ],
            [
                'code' => 'VIP50',
                'value' => 50,
                'expiration_date' => now()->addMonth()->format('Y-m-d'),
                'limit' => 10,
                'is_active' => true,
            ],
            [
                'code' => 'EXPIRED',
                'value' => 15,
                'expiration_date' => now()->subDays(1)->format('Y-m-d'),
                'limit' => 50,
                'is_active' => false,
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::firstOrCreate(
                ['code' => $coupon['code']],
                $coupon
            );
        }
    }
}
