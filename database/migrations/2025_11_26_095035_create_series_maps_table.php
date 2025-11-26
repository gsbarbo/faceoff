<?php

use App\Models\GameMap;
use App\Models\Mode;
use App\Models\Series;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('series_maps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Series::class)->constrained();
            $table->foreignIdFor(GameMap::class)->constrained();
            $table->foreignIdFor(Mode::class)->constrained();
            $table->integer('map_number');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->foreignIdFor(Team::class, 'winner_team_id')->nullable()->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('series_maps');
    }
};
