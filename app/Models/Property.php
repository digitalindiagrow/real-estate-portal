<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'category',
        'price',
        'city',
        'area',
        'address',
        'bedrooms',
        'bathrooms',
        'size_sqft',
        'furnishing',
        'preferred_for',
        'possession_status',
        'images',
        'status',
        'is_featured',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'is_featured' => 'boolean',
            'price' => 'decimal:2',
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
     * @return HasMany<Reel, $this>
     */
    public function reels(): HasMany
    {
        return $this->hasMany(Reel::class);
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

    public function scopeInCity(Builder $query, string $city): void
    {
        $query->where('city', 'like', "%{$city}%");
    }

    public function scopeInArea(Builder $query, string $area): void
    {
        $query->where('area', 'like', "%{$area}%");
    }

    public function scopeOfType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    public function scopeBedrooms(Builder $query, int $count): void
    {
        if ($count >= 4) {
            $query->where('bedrooms', '>=', 4);
        } else {
            $query->where('bedrooms', $count);
        }
    }

    public function scopeOfCategory(Builder $query, string $category): void
    {
        $query->where('category', $category);
    }

    public function scopeFurnishedAs(Builder $query, string $furnishing): void
    {
        $query->where('furnishing', $furnishing);
    }

    public function scopePreferredForType(Builder $query, string $preferredFor): void
    {
        $query->where('preferred_for', $preferredFor);
    }

    public function scopeWithPossessionStatus(Builder $query, string $status): void
    {
        $query->where('possession_status', $status);
    }
}
