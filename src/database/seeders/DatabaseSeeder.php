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
                'title' => 'Вечернее платье Allison',
                'description' => 'Вечернее платье длиной в пол из пайеточной ткани чёрного цвета. Топ без рукавов с вырезом в виде капли. Закрытая спина на молнии. Юбка длиной в пол, без шлейфа',
                'user_id' => 1,
                'quantity' => 3,
            ],
            [
                'title' => 'Вечернее платье плиссе Penelope Powder Pink',
                'description' => 'Длинное вечернее платье пепельно-розового цвета. Выполнено из плиссированной ткани. Топ в стиле американская пройма с вырезом на груди и открытыми плечами. Спинка полностью закрыта. На юбке небольшой разрез под левую ножку.',
                'user_id' => 2,
                'quantity' => 0,
            ],
            [
                'title' => 'Шуба Круэллы Cruella Coat',
                'description' => 'Шубка-макси из искусственного меха чёрно-белой расцветки под далматинца. Массивный воротник. Приталенная. Застёгивается на пуговицу.',
                'user_id' => 3,
                'quantity' => 1,
            ],
            [
                'title' => 'Fashion Hunter',
                'description' => 'Эффектное белое платье с длинными рукавами, декорированными перьями. Глубокий V-образный вырез декольте. На груди и бедре нашита прозрачная сетка со стразами. Талию украшает пояс. Длинная юбка с небольшим шлейфом и высоким разрезом по ножке. Спина закрыта, застегивается на молнию.',
                'user_id' => 4,
                'quantity' => 7,
            ],
            [
                'title' => 'Накидка из перьев со шлейфом Feather Cape Discount',
                'description' => 'Накидка из белых гусиных перьев. Спина и плечи декорированы кристаллами. Длина от верха до конца шлейфа: 3 м. 15 см. Не застегивается.',
                'user_id' => 5,
                'quantity' => 12,
            ],
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
                'title' => 'Вечерние платья',
                'description' => 'Аренда вечерних платьев для фотосессией. Аренда платьев на фотосессии, в том числе и вечерних, является одним из самых популярных видов услуг. Фотографы часто ищут для своих съемок не только одежду в прокате, но и людей с соответствующим образом, поэтому аренда платьев часто нужна. В нашей студии вы можете арендовать вечерние платья на любую тематику и для любого мероприятия. При необходимости можно даже заказать пошив вечернего платья по вашему индивидуальному эскизу.'
            ],
            [
                'title' => 'Платья для фотосессий',
                'description' => 'Шикарные и стильные платья, аксессуары и обувь в аренду для фотосессий.'
            ],
            [
                'title' => 'Свадебные платья',
                'description' => 'Свадебные платья простые, но со вкусом'
            ],
            [
                'title' => 'Платья на узату',
                'description' => 'Платья на узату'
            ],
            [
                'title' => 'Платья для подружки невесты',
                'description' => 'Разные виды платьев для фотосессий'
            ],
            [
                'title' => 'Национальные этно-костюмы',
                'description' => 'Разные виды национальных этно-костюмов'
            ],
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
            ['dress_id' => 1, 'category_id' => 1],
            ['dress_id' => 1, 'category_id' => 2],
            ['dress_id' => 2, 'category_id' => 1],
            ['dress_id' => 2, 'category_id' => 2],
            ['dress_id' => 3, 'category_id' => 3],
            ['dress_id' => 4, 'category_id' => 4],
            ['dress_id' => 4, 'category_id' => 5],
            ['dress_id' => 5, 'category_id' => 4],
            ['dress_id' => 5, 'category_id' => 5],

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
                'image' => 'evening-dress-panther-03.jpg',
                'image_small' => 'evening-dress-panther-08.jpg'
            ],
            [
                'dress_id' => 2,
                'image' => 'evening-pleated-dress-penelope-powder-pink-09.jpg',
                'image_small' => 'evening-pleated-dress-penelope-powder-pink-03.jpg'
            ],
            [
                'dress_id' => 3,
                'image' => 'shuba-cruella-coat-10.jpg',
                'image_small' => 'shuba-cruella-coat-13.jpg'
            ],
            [
                'dress_id' => 4,
                'image' => 'prokat-platya-fashion-hunter-02.jpg',
                'image_small' => 'prokat-platya-fashion-hunter-08.jpg'
            ],
            [
                'dress_id' => 5,
                'image' => 'feather-cape-with-train-02.jpg',
                'image_small' => 'feather-cape-with-train-06.jpg'
            ],

        ];

        Photo::insert($photos);
    }

    public function generateBooking()
    {
        $booking = [
            [
                'dress_id' => '1',
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
            [
                'dress_id' => '1',
                'date' => '2023-02-22',
                'status' => Booking::STATUSES['APPROVED'],
            ],
            [
                'dress_id' => '2',
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
            [
                'dress_id' => '3',
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
            [
                'dress_id' => '4',
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
            [
                'dress_id' => '5',
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
        ];
        Booking::insert($booking);
    }
}
