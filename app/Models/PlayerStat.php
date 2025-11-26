<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerStat extends Model
{
    use SoftDeletes;

    public function seriesMaps(): BelongsTo
    {
        return $this->belongsTo(SeriesMaps::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
