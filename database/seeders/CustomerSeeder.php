<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'first_name' => 'David',
            'last_name' => 'Mathew',
            'phone' => '255786776651',
            'email' => 'john@example.com',
            'region' => 'Dar es Salaam',
            'district' => 'Ilala',
            'ref' => '300300',
            'street' => 'Uhuru Street',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Customer::create([
            'first_name' => 'Anna',
            'last_name' => 'Michael',
            'phone' => '255784098890',
            'email' => 'anna@example.com',
            'region' => 'Arusha',
            'ref' => '300301',
            'district' => 'Arumeru',
            'street' => 'Clock Tower Road',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
