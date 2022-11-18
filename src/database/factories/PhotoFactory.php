<?php

namespace Database\Factories;

use App\Models\Dress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
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
            'image' => 'ptB5gjtmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.jpg',
            'image_small' => 'ptB5gjtmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.jpg'
        ];
    }
}
