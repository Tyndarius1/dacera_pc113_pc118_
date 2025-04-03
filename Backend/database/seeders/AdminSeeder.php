<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Bryan',
            'middle_name' => 'Iruna',
            'last_name' => 'Dacera',
            'address' => 'Central Barangay, Hilongos, Leyte',
            'contact_number' => '09664667689',
            'age' => 22,
            'gender' => 'Male',
            'status' => 'Single',
            'email' => 'kb.dacera@mlgcl.edu.ph',
            'password' => Hash::make('123'),
            'role' => 'admin', 
        ]);
       
    }
}
