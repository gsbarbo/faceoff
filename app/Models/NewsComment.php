<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsComment extends Model
{
    use SoftDeletes;

    public function newsArticle(): BelongsTo
    {
        return $this->belongsTo(NewsArticle::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'is_flagged' => 'boolean',
        ];
    }
}
