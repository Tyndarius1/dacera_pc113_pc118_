<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName, 
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'contact_number' => $faker->numerify('09#########'), 
                'age' => $faker->numberBetween(18, 50),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'status' => $faker->randomElement(['Single', 'Married', 'Divorced']),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'), 
                'role' => 'student',
            ]);
        }
    }
}
