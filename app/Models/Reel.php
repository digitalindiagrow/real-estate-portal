<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reel extends Model
{
    /** @use HasFactory<\Database\Factories\ReelFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'video_path',
        'thumbnail_path',
        'duration_seconds',
        'views_count',
        'status',
        'is_featured',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Property, $this>
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * @return HasMany<ReelLike, $this>
     */
    public function likes(): HasMany
    {
        return $this->hasMany(ReelLike::class);
    }

    /**
     * @return HasMany<ReelComment, $this>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ReelComment::class)->latest();
    }

    public function scopeApproved(Builder $query): void
    {
        $query->where('status', 'approved');
    }

    public function scopePending(Builder $query): void
    {
        $query->where('status', 'pending');
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function isNew(): bool
    {
        return $this->created_at?->greaterThanOrEqualTo(now()->subDays(7)) ?? false;
    }

    public function isLikedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->likes->contains('user_id', $user->id);
    }
}
