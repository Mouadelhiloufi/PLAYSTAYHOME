<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('console_id')->constrained('consoles')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->string('status')->default('active'); // active, cancelled
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
