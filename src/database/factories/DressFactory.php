<?php

namespace Database\Factories;

use App\Models\DressUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dress>
 */
class DressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $dressTitles = ['Вдова', 'Охотница', 'Ведьма', 'Модель', 'Лагуна'];
        $dressDescriptions = ['Класические', 'Вечерние', 'Коктейльные', 'Деловые', 'Повседневные'];
        return [
            'title' => $this->faker->randomElement($dressTitles),
            'description' => $this->faker->randomElement($dressDescriptions),
            'user_id' => User::get()->random()->user_id
        ];
    }
}
