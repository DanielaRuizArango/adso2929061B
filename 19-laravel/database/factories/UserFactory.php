<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $gender = $this->faker->randomElement(['male', 'female']);

    $faker = \Faker\Factory::create('es_ES');

    $firstName = $gender === 'male'
        ? $faker->firstNameMale
        : $faker->firstNameFemale;

    $lastName = $faker->lastName;

    $fullName = $firstName . ' ' . $lastName;

    $birthdate = $faker
        ->dateTimeBetween('1974-01-01', '2004-12-31')
        ->format('Y-m-d');

    // Documento (será también el nombre de la imagen)
    $document = $faker->unique()->numberBetween(100000000, 999999999);

    // Generar email combinando nombre + apellido
    $email = strtolower($firstName . '.' . $lastName) . '@gmail.com';

    // Limpiar tildes y espacios (opcional pero recomendado)
    $email = Str::ascii($email);

    $response = Http::get("https://randomuser.me/api/", [
        'gender' => $gender,
        'nat' => 'us',
        'inc' => 'picture',
    ]);

    $data = $response->json()['results'][0];
    $imageUrl = $data['picture']['large'];

    // Guardar imagen
    $directory = public_path('photos');
    if (!File::exists($directory)) {
        File::makeDirectory($directory, 0755, true);
    }

    // El nombre del archivo será el número de documento
    $fileName = $document . '.jpg';

    File::put($directory . '/' . $fileName, file_get_contents($imageUrl));

    return [
        'document' => $document,
        'fullname' => $fullName,
        'gender' => ucfirst($gender),
        'birthdate' => $birthdate,
        'photo' => 'photos/' . $fileName,
        'phone' => $faker->phoneNumber(),
        'email' => $email,
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'active' => true,
        'role' => 'Customer',
        'remember_token' => Str::random(10),
    ];
}


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}