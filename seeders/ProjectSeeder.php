<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Developer;
use App\Models\Location;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $developers = Developer::all();
        $locations = Location::all();
        Project::factory()->count(10)->make()->each(function($project) use ($developers, $locations) {
            $project->developer_id = $developers->random()->id;
            $project->location_id = $locations->random()->id;
            $project->save();
        });
    }
}
