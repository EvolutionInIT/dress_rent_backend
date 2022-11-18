<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Dress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DressColor>
 */
class DressColorFactory extends Factory
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
            'color_id' => Color::get()->random()->color_id
        ];
    }
}
