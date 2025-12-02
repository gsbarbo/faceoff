<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
    use SoftDeletes;

    protected $casts = [
        'start_date' => 'datetime:m/d/Y',
        'end_date' => 'datetime:m/d/Y',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
