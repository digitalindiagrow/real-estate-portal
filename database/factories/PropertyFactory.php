<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    private const CITY_AREAS = [
        'Mumbai' => ['Andheri', 'Bandra', 'Powai', 'Dadar'],
        'Pune' => ['Kothrud', 'Viman Nagar', 'Hinjewadi', 'Baner'],
        'Delhi' => ['Dwarka', 'Rohini', 'Saket', 'Karol Bagh'],
        'Bangalore' => ['Whitefield', 'Koramangala', 'Indiranagar', 'HSR Layout'],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = $this->faker->randomElement(array_keys(self::CITY_AREAS));
        $area = $this->faker->randomElement(self::CITY_AREAS[$city]);
        $type = $this->faker->randomElement(['sale', 'rent']);

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->randomElement([
                '2 BHK Apartment', '3 BHK Flat', 'Independent House', 'Studio Apartment', 'Luxury Villa', 'Commercial Shop',
            ]).' in '.$area,
            'description' => $this->faker->paragraph(4),
            'type' => $type,
            'price' => $type === 'rent'
                ? $this->faker->numberBetween(10, 80) * 1000
                : $this->faker->numberBetween(20, 300) * 100000,
            'city' => $city,
            'area' => $area,
            'address' => $this->faker->streetAddress(),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'size_sqft' => $this->faker->numberBetween(400, 3500),
            'images' => [],
            'status' => 'approved',
            'is_featured' => false,
        ];
    }

    public function pending(): static
    {
        return $this->state(fn () => ['status' => 'pending']);
    }

    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => 'rejected',
            'rejection_reason' => 'Incomplete or inaccurate listing details.',
        ]);
    }

    public function featured(): static
    {
        return $this->state(fn () => [
            'status' => 'approved',
            'is_featured' => true,
        ]);
    }
}
