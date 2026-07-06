<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReelLike extends Model
{
    protected $fillable = [
        'user_id',
        'reel_id',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Reel, $this>
     */
    public function reel(): BelongsTo
    {
        return $this->belongsTo(Reel::class);
    }
}
