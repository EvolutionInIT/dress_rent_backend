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
        $dress = [
            [
                'title' => 'Смок',
                'description' => 'Оборки в платье такой модели начинаются под грудью и заканчиваются выше колена.',
                'user_id' => 1,
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'title' => 'Шифт',
                'description' => 'воё название оно получило в годы молодёжной революции в Америке в конце 50-х годов.',
                'user_id' => 2,
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'title' => 'Труба',
                'description' => 'Платье труба превосходно подойдёт к типу фигуры песочные часы, а также фигуре с тонкой талией.',
                'user_id' => 3,
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'title' => 'Шемиз',
                'description' => 'Платье данного типа берёт свои корни из далёкого средневековья, когда оно ещё не было платьем.',
                'user_id' => 4,
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'title' => 'Футляр',
                'description' => 'Пожалуй, самая незаменимая вещь в гардеробе каждой женщины. Дамы вы понимаете о чём я?!',
                'user_id' => 5,
                'updated_at' => now(),
                'created_at' => now()
            ]
        ];
        Dress::insert($dress);
    }

    public function generateCategory()
    {
        $category = [
            [
                'title' => 'Зимние',
                'description' => 'Светлая кожа контрастирует с темными волосами и глазами зачастую тоже темными.',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'title' => 'Летние',
                'description' => 'Несмотря на летнее название цветотип «лето» довольно холодный. У него нет такого яркого контраста.',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'title' => 'Весенние',
                'description' => 'Во всем облике девушки «весны» чувствуется мягкость и нежность: светлые шатенки и натуральные блондинки.',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'title' => 'Осенние',
                'description' => 'Яркие краски осени отражаются в этом цветотипе.Глаза яркие – синие, зеленые, серые, шоколадные.',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'title' => 'Коктейльные',
                'description' => 'сли вы собираетесь посетить шумную вечеринку или провести вечер со своей второй половинкой в ресторане.',
                'updated_at' => now(),
                'created_at' => now()
            ]
        ];
        Category::insert($category);
    }

    public function generateDressCategory()
    {
        $dressCategory = [
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'category_id' => Category::get()->random()->category_id
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'category_id' => Category::get()->random()->category_id
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'category_id' => Category::get()->random()->category_id
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'category_id' => Category::get()->random()->category_id
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'category_id' => Category::get()->random()->category_id
            ]
        ];
        DressCategory::insert($dressCategory);
    }

    public function generateUser()
    {
        $user = [
            [
                'name' => 'Анжела',
                'email' => 'Anjela@gmail.com',
                'email_verified_at' => now(),
                'password' => '123qweasdzxc/.e2hdosaud',
                'remember_token' => 'LV6OF34fD3',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'name' => 'Виктория',
                'email' => 'Victorya@gmail.com',
                'email_verified_at' => now(),
                'password' => '123qweasaadzxc/.e2hdosaud',
                'remember_token' => 'NOV6OF34fD3',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'name' => 'Валерия',
                'email' => 'Valeria@gmail.com',
                'email_verified_at' => now(),
                'password' => '123qweafxcsdzxc/.e2hdosaud',
                'remember_token' => 'KIQ6OF34fD3',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'name' => 'Анастасия',
                'email' => 'Anastasiya@gmail.com',
                'email_verified_at' => now(),
                'password' => '123qweasfadzxc/.e2hdosaud',
                'remember_token' => 'MAL6OF34fD3',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'name' => 'Алтынай',
                'email' => 'Altinay@gmail.com',
                'email_verified_at' => now(),
                'password' => '123qweaplazxc/.e2hdosaud',
                'remember_token' => 'MUL6OF34fD3',
                'updated_at' => now(),
                'created_at' => now()
            ],
        ];
        User::insert($user);
    }

    public function generateColor()
    {
        $color = [
            ['color' => 'Blue'],
            ['color' => 'Black'],
            ['color' => 'Red'],
            ['color' => 'Purple'],
            ['color' => 'White'],
        ];
        Color::insert($color);
    }

    public function generateDressColor()
    {
        $dressColor = [
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'color_id' => Color::get()->random()->color_id,
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'color_id' => Color::get()->random()->color_id,
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'color_id' => Color::get()->random()->color_id,
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'color_id' => Color::get()->random()->color_id,
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'color_id' => Color::get()->random()->color_id,
            ],
        ];
        DressColor::insert($dressColor);
    }

    public function generateSize()
    {
        $size = [
            ['size' => 'S'],
            ['size' => 'M'],
            ['size' => 'L'],
            ['size' => 'XS'],
            ['size' => 'XM']
        ];
        Size::insert($size);
    }

    public function generateDressSize()
    {
        $dressSize = [
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'size_id' => Size::get()->random()->size_id
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'size_id' => Size::get()->random()->size_id
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'size_id' => Size::get()->random()->size_id
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'size_id' => Size::get()->random()->size_id
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'size_id' => Size::get()->random()->size_id
            ],
        ];
        DressSize::insert($dressSize);
    }

    public function generatePhoto()
    {
        $photo = [
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'image' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.jpg',
                'image_small' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.png'
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'image' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.jpg',
                'image_small' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.png'
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'image' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.jpg',
                'image_small' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.png'
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'image' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.jpg',
                'image_small' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.png'
            ],
            [
                'dress_id' => Dress::get()->random()->dress_id,
                'image' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.jpg',
                'image_small' => 'ptB5gjttmsiXEFK5dk8saMnHLOMcFqbWncVDsCx3s.png'
            ],
        ];
        Photo::insert($photo);
    }
}
