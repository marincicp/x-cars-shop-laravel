<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]);
    }
}
