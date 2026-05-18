<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->decimal('promo_price', 10, 2)->nullable()->after('daily_price');
            $table->date('promo_starts_at')->nullable()->after('promo_price');
            $table->date('promo_ends_at')->nullable()->after('promo_starts_at');
            $table->boolean('promo_active')->default(false)->after('promo_ends_at');
        });
    }

    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->dropColumn([
                'promo_price',
                'promo_starts_at',
                'promo_ends_at',
                'promo_active',
            ]);
        });
    }
};