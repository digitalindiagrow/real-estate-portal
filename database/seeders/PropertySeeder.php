<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sellers = User::where('role', 'user')->get();

        Property::factory()->count(30)->for($sellers->random())->create();
        Property::factory()->featured()->count(6)->for($sellers->random())->create();
        Property::factory()->pending()->count(3)->for($sellers->random())->create();
        Property::factory()->rejected()->count(2)->for($sellers->random())->create();
    }
}
