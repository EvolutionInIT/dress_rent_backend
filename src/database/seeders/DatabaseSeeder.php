<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Color;
use App\Models\Dress;
use App\Models\DressCategory;
use App\Models\DressColor;
use App\Models\DressSize;
use App\Models\Photo;
use App\Models\Size;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
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
        $this->generateBooking();
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

        foreach ($dresses as $dress)
            $resultDresses [] = array_merge($dress, $dressData);

        Dress::insert($resultDresses);

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

        foreach ($categories as $category)
            $resultCategories [] = array_merge($category, $categoryData);

        Category::insert($resultCategories);
    }

    public function generateDressCategory()
    {
        $dressCategories = [
            ['dress_id' => 1, 'category_id' => 3],
            ['dress_id' => 1, 'category_id' => 5],
            ['dress_id' => 2, 'category_id' => 5],
            ['dress_id' => 2, 'category_id' => 2],
            ['dress_id' => 3, 'category_id' => 4],
            ['dress_id' => 4, 'category_id' => 1],
            ['dress_id' => 5, 'category_id' => 2],
            ['dress_id' => 5, 'category_id' => 3]
        ];
        DressCategory::insert($dressCategories);
    }

    public function generateUser()
    {
        $users = [
            [
                'name' => 'Анжела',
                'email' => 'Anjela@gmail.com',
                'password' => bcrypt(10)
            ],
            [
                'name' => 'Виктория',
                'email' => 'Victorya@gmail.com',
                'password' => bcrypt(10)
            ],
            [
                'name' => 'Валерия',
                'email' => 'Valeria@gmail.com',
                'password' => bcrypt(10)
            ],
            [
                'name' => 'Анастасия',
                'email' => 'Anastasiya@gmail.com',
                'password' => bcrypt(10)
            ],
            [
                'name' => 'Алтынай',
                'email' => 'Altinay@gmail.com',
                'password' => bcrypt(10)
            ],
        ];

        $userData = [
            'updated_at' => now(),
            'created_at' => now(),
            'email_verified_at' => now()
        ];

        foreach ($users as $user)
            $resultUsers [] = array_merge($user, $userData);

        User::insert($resultUsers);
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
            ['dress_id' => 1, 'color_id' => 2],
            ['dress_id' => 1, 'color_id' => 4],
            ['dress_id' => 2, 'color_id' => 2],
            ['dress_id' => 2, 'color_id' => 3],
            ['dress_id' => 3, 'color_id' => 5],
            ['dress_id' => 3, 'color_id' => 2],
            ['dress_id' => 4, 'color_id' => 3],
            ['dress_id' => 4, 'color_id' => 1],
            ['dress_id' => 5, 'color_id' => 4],
            ['dress_id' => 5, 'color_id' => 5]
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
            ['dress_id' => 1, 'size_id' => 5],
            ['dress_id' => 1, 'size_id' => 2],
            ['dress_id' => 2, 'size_id' => 3],
            ['dress_id' => 2, 'size_id' => 2],
            ['dress_id' => 3, 'size_id' => 5],
            ['dress_id' => 3, 'size_id' => 4],
            ['dress_id' => 4, 'size_id' => 2],
            ['dress_id' => 4, 'size_id' => 3],
            ['dress_id' => 5, 'size_id' => 1],
            ['dress_id' => 5, 'size_id' => 2],
        ];
        DressSize::insert($dressSizes);
    }

    public function generatePhoto()
    {
        $photos = [
            [
                'dress_id' => 1,
                'image' => 'luxury-2021_850x1122.jpg.pagespeed.ce.QPOnS1cQpX.jpg',
                'image_small' => 'moda_platya-5-819x1024.jpg'
            ],
            [
                'dress_id' => 1,
                'image' => '11-10.jpg',
                'image_small' => '1662166731_1-damion-club-p-neobichnie-fasoni-vechernikh-platev-modnie-1.jpg'
            ],
            [
                'dress_id' => 1,
                'image' => 'love.jpg',
                'image_small' => 'luxury-2021_850x1122.jpg.pagespeed.ce.QPOnS1cQpX.jpg'
            ],
            [
                'dress_id' => 2,
                'image' => 'love.jpg',
                'image_small' => 'White-.jpg'
            ],
            [
                'dress_id' => 2,
                'image' => 'love.jpg',
                'image_small' => 'moda_platya-5-819x1024.jpg'
            ],
            [
                'dress_id' => 3,
                'image' => 'love.jpg',
                'image_small' => 'White-.jpg'
            ],
            [
                'dress_id' => 3,
                'image' => 'love.jpg',
                'image_small' => 'luxury-2021_850x1122.jpg.pagespeed.ce.QPOnS1cQpX.jpg'
            ],
            [
                'dress_id' => 4,
                'image' => 'love.jpg',
                'image_small' => 'images.jpeg'
            ],
            [
                'dress_id' => 4,
                'image' => 'images.jpeg',
                'image_small' => 'luxury-2021_850x1122.jpg.pagespeed.ce.QPOnS1cQpX.jpg'
            ],
            [
                'dress_id' => 5,
                'image' => 'modnye-vechernie-platya-960-540-960x540.jpg',
                'image_small' => 'luxury-2021_850x1122.jpg.pagespeed.ce.QPOnS1cQpX.jpg'
            ],

        ];

        Photo::insert($photos);
    }

    public function generateBooking()
    {
        $booking = [
            [
                'start_date' => '19.01.2023',
                'end_date' => '22.01.2023',
                'dress_id' => '1',
                'date' => today(),
                'status' => Booking::UNAVAILABLE_DRESS,
            ],
            [
                'start_date' => '19.01.2023',
                'end_date' => '22.01.2023',
                'dress_id' => '2',
                'date' => today(),
                'status' => Booking::UNAVAILABLE_DRESS,
            ],
            [
                'start_date' => '19.01.2023',
                'end_date' => '22.01.2023',
                'dress_id' => '3',
                'date' => today(),
                'status' => Booking::UNAVAILABLE_DRESS,
            ],
            [
                'start_date' => '19.01.2023',
                'end_date' => '22.01.2023',
                'dress_id' => '4',
                'date' => today(),
                'status' => Booking::UNAVAILABLE_DRESS,
            ],
            [
                'start_date' => '19.01.2023',
                'end_date' => '22.01.2023',
                'dress_id' => '5',
                'date' => today(),
                'status' => Booking::UNAVAILABLE_DRESS,
            ],

        ];
        Booking::insert($booking);
    }
}
