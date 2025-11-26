<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_map_mode', function (Blueprint $table) {
            $table->foreignId('game_map_id')->constrained();
            $table->foreignId('mode_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_map_mode');
    }
};
