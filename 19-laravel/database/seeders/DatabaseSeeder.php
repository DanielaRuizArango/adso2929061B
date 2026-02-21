<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pet;
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
        // Seeders
        $this->call([
            UserSeeder::class,
            PetSeeder::class,
            AdoptionSeeder::class

        ]);
        
        // Factory
        //                     User::factory()->count(50)->create();
        Pet::factory()->count(50)->create();
    }
}