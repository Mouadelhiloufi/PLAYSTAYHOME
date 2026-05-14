<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('reservations') && Schema::hasColumn('reservations', 'status')) {
            DB::table('reservations')->where('status', 'active')->update(['status' => 'pending']);
            DB::table('reservations')->where('status', 'completed')->update(['status' => 'accepted']);
            DB::table('reservations')->where('status', 'cancelled')->update(['status' => 'refused']);

            if (DB::getDriverName() === 'mysql') {
                DB::statement("ALTER TABLE reservations MODIFY status VARCHAR(255) NOT NULL DEFAULT 'pending'");
            }
        } elseif (! Schema::hasColumn('reservations', 'status')) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->string('status')->default('pending');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('reservations') && Schema::hasColumn('reservations', 'status')) {
            if (DB::getDriverName() === 'mysql') {
                DB::statement("ALTER TABLE reservations MODIFY status VARCHAR(255) NOT NULL DEFAULT 'active'");
            }

            DB::table('reservations')->where('status', 'pending')->update(['status' => 'active']);
            DB::table('reservations')->where('status', 'accepted')->update(['status' => 'completed']);
            DB::table('reservations')->where('status', 'refused')->update(['status' => 'cancelled']);
        }
    }
};