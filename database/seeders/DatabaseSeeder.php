<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'full_name' => 'Test User 1',
            'email' => 'test1@example.com',
            'account_number' => '1000000001',
            'balance' => 5000000,
        ]);

        User::factory()->create([
            'full_name' => 'Test User 2',
            'email' => 'test2@example.com',
            'account_number' => '1000000002',
            'balance' => 3000000,
        ]);
    }
}
