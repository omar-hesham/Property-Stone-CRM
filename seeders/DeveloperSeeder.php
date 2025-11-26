<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Developer;

class DeveloperSeeder extends Seeder
{
    public function run()
    {
        Developer::factory()->count(5)->create();
    }
}
