<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Dress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DressCategory>
 */
class DressCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dress_id' => Dress::get()->random()->dress_id,
            'category_id' => Category::get()->random()->category_id
        ];
    }
}
