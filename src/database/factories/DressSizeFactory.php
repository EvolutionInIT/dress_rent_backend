<?php

namespace Database\Factories;

use App\Models\Dress;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DressSize>
 */
class DressSizeFactory extends Factory
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
            'size_id' => Size::get()->random()->size_id
        ];
    }
}
