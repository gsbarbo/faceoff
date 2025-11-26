<?php

use App\Models\Game;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banned_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Game::class)->constrained();
            $table->string('type');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banned_items');
    }
};
