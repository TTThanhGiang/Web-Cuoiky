<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogCategory::create(['name' => 'Notification']);
        BlogCategory::create(['name' => 'Post']);
        BlogCategory::create(['name' => 'Schedule']);
    }

}