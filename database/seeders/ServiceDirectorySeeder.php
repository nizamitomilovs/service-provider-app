<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Database\Seeder;

class ServiceDirectorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->count(5)->create();
        Provider::factory()->count(40)->create();
    }
}
