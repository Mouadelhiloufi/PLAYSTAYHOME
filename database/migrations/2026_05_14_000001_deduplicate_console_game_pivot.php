<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $duplicates = DB::table('console_game')
            ->select('console_id', 'game_id')
            ->selectRaw('MIN(id) as keep_id, COUNT(*) as duplicate_count')
            ->groupBy('console_id', 'game_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            DB::table('console_game')
                ->where('console_id', $duplicate->console_id)
                ->where('game_id', $duplicate->game_id)
                ->where('id', '!=', $duplicate->keep_id)
                ->delete();
        }

        Schema::table('console_game', function (Blueprint $table) {
            $table->unique(['console_id', 'game_id'], 'console_game_console_id_game_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('console_game', function (Blueprint $table) {
            $table->dropUnique('console_game_console_id_game_id_unique');
        });
    }
};
