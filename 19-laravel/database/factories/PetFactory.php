<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $petNames = [ 'Luna', 'Mateo', 'Max', 'Bruno', 'Bella', 'Rocky', 'Toby', 'Lola', 'Nala', 'Coco','Café', 'Tinto', 'Cacao', 'Guaro', 'Caribe', 'Chocó', 'Andes', 'Llanero', 'Arepa', 'Zenú','Gabo', 'Chente', 'Dalí', 'Shakira', 'Simba', 'Thor', 'Zeus', 'Hachiko', 'Marley', 'Lio','Firulais', 'Manchas', 'Motas', 'Pitufo', 'Bizcocho', 'Socio', 'Gomelo', 'Chusco', 'Pillo', 'Botas','Milo', 'Kira', 'Zoe', 'Loki', 'Oreo', 'Stella', 'Rio', 'Apolo', 'Frida', 'Maya'];
        $dogBreeds = ['Labrador', 'German Shepherd', 'Golden Retriever', 'Bulldog', 'Poodle', 'Beagle', 'Rottweiler', 'Dachshund', 'Siberian Husky', 'Boxer'];
        $catBreeds = ['Siamese', 'Persian', 'Maine Coon', 'Ragdoll', 'British Shorthair', 'Bengal', 'Sphynx', 'Abyssinian', 'Scottish Fold', 'American Shorthair'];
        $pigBreeds = ['Pot-bellied pig', 'Yorkshire', 'Berkshire', 'Duroc', 'Landrace', 'Chester White', 'Hampshire', 'Poland China', 'Spotted', 'Tamworth'];
        $birdBreeds = ['Canary', 'Finch', 'Parakeet', 'Cockatiel', 'Lovebird', 'Macaw', 'Parrot', 'Finch', 'Canary', 'Budgerigar'];

        $kind = fake()->randomElement(['Dog', 'Cat', 'Pig', 'Bird']);

        switch ($kind) {
            case 'Dog':
                $breed = fake()->randomElement($dogBreeds);
                break;
            case 'Cat':
                $breed = fake()->randomElement($catBreeds);
                break;
            case 'Pig':
                $breed = fake()->randomElement($pigBreeds);
                break;
            case 'Bird':
                $breed = fake()->randomElement($birdBreeds);
                break;
        }
        
        return [
        'name'=> fake()->randomElement($petNames),
        'kind'=> $kind,
        'weight'=> fake()->numerify('#.#'),
        'age'=> fake()->numberBetween(1, 15),
        'breed'=> $breed,
        'location'=> fake()->city(),
        'description'=> fake()->sentence(5)
        ];
    }
}
