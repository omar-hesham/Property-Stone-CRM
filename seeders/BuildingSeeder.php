<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\Project;

class BuildingSeeder extends Seeder
{
    public function run()
    {
        $projects = Project::all();
        foreach ($projects as $project) {
            Building::factory()->count(2)->create(['project_id' => $project->id]);
        }
    }
}
