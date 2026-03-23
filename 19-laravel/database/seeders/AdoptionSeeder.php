<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adoption;
use App\Models\Pet;

class AdoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adoption = new Adoption();
        $adoption->user_id = 2;
        $adoption->pet_id = 2;
        if($adoption->save()){
            $pet = Pet::find(2);
            $pet->adopted = 1;
            $pet->save();
        }

         $adoption = new Adoption();
        $adoption->user_id = 2;
        $adoption->pet_id = 1;
        if($adoption->save()){
            $pet = Pet::find(1);
            $pet->adopted = 1;
            $pet->save();
        }
    }
}
