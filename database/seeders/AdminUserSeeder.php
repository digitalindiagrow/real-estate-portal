<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@realestate.test',
            'password' => 'password',
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Demo Seller',
            'email' => 'seller@realestate.test',
            'password' => 'password',
            'role' => 'user',
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Demo Buyer',
            'email' => 'buyer@realestate.test',
            'password' => 'password',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
