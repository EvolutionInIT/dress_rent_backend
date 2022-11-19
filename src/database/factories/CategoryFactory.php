<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

//        $categoryDesc = ['Класические', 'Вечерние', 'Коктейльные', 'Деловые', 'Повседневные'];
//        $desc = [];
//        foreach ($categoryDesc as $val) {
//            $desc [] = [
//                'title' => 'Платья',
//                'description' => $val
//            ];
//        }
//        dd($desc);
//        return $desc;

        $categoryDescriptions = ['Класические', 'Вечерние', 'Коктейльные', 'Деловые', 'Повседневные'];
        return [
            'title' => 'Платье',
            'description' => $this->faker->randomElement($categoryDescriptions)
        ];
    }
}


