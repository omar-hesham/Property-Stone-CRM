<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Building;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $buildings = Building::all();
        foreach ($buildings as $building) {
            Unit::factory()->count(10)->create(['building_id' => $building->id, 'project_id' => $building->project_id]);
        }
    }
}
