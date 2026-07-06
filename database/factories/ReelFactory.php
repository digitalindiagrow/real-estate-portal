<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Reel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reel>
 */
class ReelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'property_id' => Property::factory(),
            'video_path' => 'reels/videos/'.$this->faker->uuid().'.mp4',
            'thumbnail_path' => null,
            'duration_seconds' => $this->faker->numberBetween(10, 60),
            'status' => 'approved',
            'is_featured' => false,
        ];
    }
}
