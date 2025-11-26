<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeriesMap extends Model
{
    use SoftDeletes;

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    public function gameMap(): BelongsTo
    {
        return $this->belongsTo(GameMap::class);
    }

    public function mode(): BelongsTo
    {
        return $this->belongsTo(Mode::class);
    }

    public function winnerTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'winner_team_id');
    }
}
