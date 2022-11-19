<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Dress;
use App\Models\DressCategory;
use App\Models\DressColor;
use App\Models\DressSize;
use App\Models\Photo;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Category::factory(5)->create();
        Dress::factory(5)->create();
        Color::factory(5)->create();
        Size::factory(5)->create();
        Photo::factory(5)->create();
        DressCategory::factory(5)->create();
        DressColor::factory(5)->create();
        DressSize::factory(5)->create();
    }
}
