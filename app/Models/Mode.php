<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mode extends Model
{
    use SoftDeletes;

    public function gameMaps(): BelongsToMany
    {
        return $this->belongsToMany(GameMap::class, 'game_map_mode', 'mode_id', 'game_map_id');
    }
}
