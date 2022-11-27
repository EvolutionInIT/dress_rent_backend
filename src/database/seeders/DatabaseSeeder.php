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
        $this->generateCategory();
        $this->generateUser();
        $this->generateDress();
        $this->generateDressCategory();
        $this->generateColor();
        $this->generateDressColor();
        $this->generateSize();
        $this->generateDressSize();
        $this->generatePhoto();
    }

    public function generateDress()
    {
        $dresses = [
            [
                'title' => 'Смок',
                'description' => 'Оборки в платье такой модели начинаются под грудью и заканчиваются выше колена.',
                'user_id' => 1
            ],
            [
                'title' => 'Шифт',
                'description' => 'воё название оно получило в годы молодёжной революции в Америке в конце 50-х годов.',
                'user_id' => 2
            ],
            [
                'title' => 'Труба',
                'description' => 'Платье труба превосходно подойдёт к типу фигуры песочные часы, а также фигуре с тонкой талией.',
                'user_id' => 3
            ],
            [
                'title' => 'Шемиз',
                'description' => 'Платье данного типа берёт свои корни из далёкого средневековья, когда оно ещё не было платьем.',
                'user_id' => 4
            ],
            [
                'title' => 'Футляр',
                'description' => 'Пожалуй, самая незаменимая вещь в гардеробе каждой женщины. Дамы вы понимаете о чём я?!',
                'user_id' => 5
            ]
        ];

        $dressData = [
            'updated_at' => now(),
            'created_at' => now()
        ];

        foreach ($dresses as $dress) {
            $resultDresses = array_merge($dress, $dressData);
            Dress::insert($resultDresses);
        }
    }

    public function generateCategory()
    {
        $categories = [
            [
                'title' => 'Зимние',
                'description' => 'Светлая кожа контрастирует с темными волосами и глазами зачастую тоже темными.'
            ],
            [
                'title' => 'Летние',
                'description' => 'Несмотря на летнее название цветотип «лето» довольно холодный. У него нет такого яркого контраста.'
            ],
            [
                'title' => 'Весенние',
                'description' => 'Во всем облике девушки «весны» чувствуется мягкость и нежность: светлые шатенки и натуральные блондинки.'
            ],
            [
                'title' => 'Осенние',
                'description' => 'Яркие краски осени отражаются в этом цветотипе.Глаза яркие – синие, зеленые, серые, шоколадные.'
            ],
            [
                'title' => 'Коктейльные',
                'description' => 'сли вы собираетесь посетить шумную вечеринку или провести вечер со своей второй половинкой в ресторане.'
            ]
        ];
        $categoryData = [
            'updated_at' => now(),
            'created_at' => now()
        ];
        foreach ($categories as $category) {
            $resultCategories = array_merge($category, $categoryData);
            Category::insert($resultCategories);
        }
    }

    public function generateDressCategory()
    {
        $dressCategories = [
            ['dress_id' => 1, 'category_id' => 3],
            ['dress_id' => 2, 'category_id' => 5],
            ['dress_id' => 3, 'category_id' => 4],
            ['dress_id' => 4, 'category_id' => 1],
            ['dress_id' => 5, 'category_id' => 2]
        ];
        DressCategory::insert($dressCategories);
    }

    public function generateUser()
    {
        $users = [
            [
                'name' => 'Анжела',
                'email' => 'Anjela@gmail.com',
                'password' => '123qweasdzxc/.e2hdosaud',
                'remember_token' => 'LV6OF34fD3',
            ],
            [
                'name' => 'Виктория',
                'email' => 'Victorya@gmail.com',
                'password' => '123qweasaadzxc/.e2hdosaud',
                'remember_token' => 'NOV6OF34fD3',
            ],
            [
                'name' => 'Валерия',
                'email' => 'Valeria@gmail.com',
                'password' => '123qweafxcsdzxc/.e2hdosaud',
                'remember_token' => 'KIQ6OF34fD3',
            ],
            [
                'name' => 'Анастасия',
                'email' => 'Anastasiya@gmail.com',
                'password' => '123qweasfadzxc/.e2hdosaud',
                'remember_token' => 'MAL6OF34fD3',
            ],
            [
                'name' => 'Алтынай',
                'email' => 'Altinay@gmail.com',
                'password' => '123qweaplazxc/.e2hdosaud',
                'remember_token' => 'MUL6OF34fD3',
            ],
        ];

        $userData = [
            'updated_at' => now(),
            'created_at' => now(),
            'email_verified_at' => now()
        ];

        foreach ($users as $user) {
            $resultUsers = array_merge($user, $userData);
            User::insert($resultUsers);
        }
    }

    public function generateColor()
    {
        $colors = [
            ['color' => 'Blue'],
            ['color' => 'Black'],
            ['color' => 'Red'],
            ['color' => 'Purple'],
            ['color' => 'White'],
        ];
        Color::insert($colors);
    }

    public function generateDressColor()
    {
        $dressColors = [
            ['dress_id' => 1, 'color_id' => 1],
            ['dress_id' => 2, 'color_id' => 2],
            ['dress_id' => 3, 'color_id' => 5],
            ['dress_id' => 4, 'color_id' => 3],
            ['dress_id' => 5, 'color_id' => 4],
        ];
        DressColor::insert($dressColors);
    }

    public function generateSize()
    {
        $sizes = [
            ['size' => 'S'],
            ['size' => 'M'],
            ['size' => 'L'],
            ['size' => 'XS'],
            ['size' => 'XM']
        ];
        Size::insert($sizes);
    }

    public function generateDressSize()
    {
        $dressSizes = [
            ['dress_id' => 1, 'size_id' => 4],
            ['dress_id' => 2, 'size_id' => 3],
            ['dress_id' => 3, 'size_id' => 5],
            ['dress_id' => 4, 'size_id' => 2],
            ['dress_id' => 5, 'size_id' => 1],
        ];
        DressSize::insert($dressSizes);
    }

    public function generatePhoto()
    {
        $photos = [
            ['dress_id' => 1],
            ['dress_id' => 2],
            ['dress_id' => 3],
            ['dress_id' => 4],
            ['dress_id' => 5],
        ];

        $images = [
            'image' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.jpg',
            'image_small' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.png'
        ];

        foreach ($photos as $photo) {
            $resultPhoto = array_merge($photo, $images);
            Photo::insert($resultPhoto);
        }

    }
}
