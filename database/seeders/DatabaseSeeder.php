<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Joskin Joseph',
            'username' => 'Joskin',
            'password' => 'password'
           ]);
        Todo::factory(20)->create([
            'user_id' => $user->id
        ]);
    }
}
