<?php

use App\Models\Event;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Event::class)->constrained();
            $table->foreignIdFor(Team::class, 'team_a_id')->constrained();
            $table->foreignIdFor(Team::class, 'team_b_id')->constrained();
            $table->foreignIdFor(Team::class, 'winner_team_id')->nullable()->constrained();
            $table->dateTime('scheduled_at');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->integer('best_of');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
