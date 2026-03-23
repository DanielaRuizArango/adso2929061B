<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Eloquent: ORM 
        $user = new User();
        $user->document = "75000001";
        $user->fullname = "John Wick";
        $user->gender = "Male";
        $user->birthdate = "1964-09-02";
        $user->phone = "3100000001";
        $user->email = "john@email.com";
        $user->password = "admin";
        $user->role = "admin";
        $user->save();

        //Array 
        DB::table('users')->insert([
            'document' => '75000002',
            'fullname' => 'Lara Croft',
            'gender' => 'Female',
            'birthdate' => '1968-02-14',
            'phone' => '3100000002',
            'email' => 'larac@email.com',
            'password' => bcrypt('12345'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
