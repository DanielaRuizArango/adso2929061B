<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pet = new Pet();
        $pet->name = "Firulais";
        $pet->kind = "Dog";
        $pet->weight = "10";
        $pet->age = "2";
        $pet->breed = "Golden Retriever";
        $pet->location = "Bogota";
        $pet->description = "Friendly dog";
        $pet->adopted = true;
        $pet->save();

        
        $pet = new Pet();
        $pet->name = "Michi";
        $pet->kind = "Cat";
        $pet->weight = "5";
        $pet->age = "1";
        $pet->breed = "Siamese";
        $pet->location = "Cali";
        $pet->description = "Friendly cat";
        $pet->adopted = true;
        $pet->save();

        $pet = new Pet();
        $pet->name = "Benjamin";
        $pet->kind = "Dog";
        $pet->weight = "18";
        $pet->age = "9";
        $pet->breed = "Beagle";
        $pet->location = "Medellin";
        $pet->description = "fat";
        $pet->adopted = true;
        $pet->save();

        $pet = new Pet();
        $pet->name = "Coco";
        $pet->kind = "cat";
        $pet->weight = "5";
        $pet->age = "2";
        $pet->breed = "Persian";
        $pet->location = "Pereira";
        $pet->description = "bites";
        $pet->adopted = true;
        $pet->save();

        $pet = new Pet();
        $pet->name = "Milo";
        $pet->kind = "cat";
        $pet->weight = "6";
        $pet->age = "2";
        $pet->breed = "Persian";
        $pet->location = "Armenia";
        $pet->description = "sleepy";
        $pet->adopted = true;
        $pet->save();
    }
}

