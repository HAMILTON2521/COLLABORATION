<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dar = Region::where('name', 'Dar es Salaam')->first()->id;
        $coast = Region::where('name', 'Pwani')->first()->id;

        District::create([
            'name' => 'Ubungo',
            'region_id' => $dar
        ]);

        District::create([
            'name' => 'Ilala',
            'region_id' => $dar
        ]);

        District::create([
            'name' => 'Kinondoni',
            'region_id' => $dar
        ]);

        District::create([
            'name' => 'Chalinze',
            'region_id' => $coast
        ]);
        District::create([
            'name' => 'Kibaha',
            'region_id' => $coast
        ]);
    }
}
