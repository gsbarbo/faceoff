<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameMap extends Model
{
    use SoftDeletes;

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function modes(): BelongsToMany
    {
        return $this->belongsToMany(Mode::class, 'game_map_mode', 'game_map_id', 'mode_id');
    }
}
