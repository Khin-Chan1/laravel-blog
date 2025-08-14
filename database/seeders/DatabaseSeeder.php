<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate(); //to delete old seeder in database
        Blog::truncate();
        Category::truncate();

        $frontend = Category::factory()->create([
            'name' => 'frontend',
        ]);

        $backend = Category::factory()->create([
            'name' => 'backend',
        ]);

        Blog::factory(2)->create([
            'category_id' => $frontend->id,
        ]);
        Blog::factory(2)->create([
            'category_id' => $backend->id,
        ]);
    }
}
