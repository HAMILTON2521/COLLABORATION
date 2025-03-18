<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Bryson',
            'last_name' => 'Mahuvi',
            'email' => 'bmahuvi@gmail.com',
            'phone' => '0762691069',
            'user_type' => 'Admin',
            'password' => Hash::make('1')
        ]);
    }
}
