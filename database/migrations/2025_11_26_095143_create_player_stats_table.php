<?php

use App\Models\Player;
use App\Models\SeriesMap;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SeriesMap::class)->constrained();
            $table->foreignIdFor(Player::class)->constrained();
            $table->integer('kills')->nullable();
            $table->integer('deaths')->nullable();
            $table->integer('assists')->nullable();
            $table->integer('damage')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_stats');
    }
};
