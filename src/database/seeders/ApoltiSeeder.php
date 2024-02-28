<?php

namespace Database\Seeders;

use App\Models\V1\Category;
use App\Models\V1\Color;
use App\Models\V1\ColorTranslation;
use App\Models\V1\Dress;
use App\Models\V1\DressPrice;
use App\Models\V1\DressTranslation;
use App\Models\V1\Photo;
use App\Models\V1\Size;
use Illuminate\Database\Seeder;

class ApoltiSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $ds = new DatabaseSeeder();
        $ds->generateLanguages();
        $ds->generateCurrencies();
        $ds->generateCategory();
        $ds->generatePermissions();
        $ds->generateUser();
        $this->generateColor();
        $this->generateSize();

        $this->generateDress();
        $this->generateDressTranslation();

        //$ds->generateBooking();

        $this->updateCategories();
    }

    public function generateSize()
    {
        $sizes = [
            ['size' => '42-44'],
            ['size' => '42-46'],
            ['size' => '42-48'],
            ['size' => '42-50'],
            ['size' => '42-52'],
            ['size' => '125-135'],
            ['size' => '135-145'],
            ['size' => '48-52'],
            ['size' => '135-160'],
        ];
        Size::insert($sizes);
    }

    public function generateColor()
    {
        $colors = [
            ['color' => 'black'],
            ['color' => 'white'],
            ['color' => '#D1C6E6'], //сиреневый
            ['color' => '#E5589C'], //фуксия
            ['color' => 'purple'],
            ['color' => 'yellow'],
            ['color' => '#6CB5BC'], //бирюзовый
            ['color' => 'pink'],
            ['color' => '#8EB1B5'],
            ['color' => '#01676C'], //зеленый
            ['color' => 'red'],
            ['color' => '#FFE7DD'], //кремовый
            ['color' => '#19578A'], //темно-синий
            ['color' => 'blue'],    //электро-синий
            ['color' => '#AABBCF'], //голубой
        ];
        Color::insert($colors);
        $this->generateColorTranslation();
    }

    public function generateColorTranslation()
    {
        $colorsTranslations = [
            [
                'color_id' => 1,
                'language' => 'en',
                'title' => 'black',
            ],
            [
                'color_id' => 1,
                'language' => 'ru',
                'title' => 'черный',
            ],
            [
                'color_id' => 1,
                'language' => 'kk',
                'title' => 'Қара',
            ],

            [
                'color_id' => 2,
                'language' => 'en',
                'title' => 'white',
            ],
            [
                'color_id' => 2,
                'language' => 'ru',
                'title' => 'Белый',
            ],
            [
                'color_id' => 2,
                'language' => 'kk',
                'title' => 'ақ',
            ],

            [
                'color_id' => 3,
                'language' => 'en',
                'title' => 'light purple',
            ],
            [
                'color_id' => 3,
                'language' => 'ru',
                'title' => 'светло-фиолетовый',
            ],
            [
                'color_id' => 3,
                'language' => 'kk',
                'title' => 'ашық күлгін',
            ],

            [
                'color_id' => 4,
                'language' => 'en',
                'title' => 'fuchsia (Hollywood light cherry)',
            ],
            [
                'color_id' => 4,
                'language' => 'ru',
                'title' => 'фуксия (голливудский светло-вишнёвый)',
            ],
            [
                'color_id' => 4,
                'language' => 'kk',
                'title' => 'фуксия (Голливудтың жеңіл шие)',
            ],
            [
                'color_id' => 5,
                'language' => 'en',
                'title' => 'purple',
            ],
            [
                'color_id' => 5,
                'language' => 'ru',
                'title' => 'фиолетовый',
            ],
            [
                'color_id' => 5,
                'language' => 'kk',
                'title' => 'күлгін',
            ],
            [
                'color_id' => 6,
                'language' => 'en',
                'title' => 'yellow',
            ],
            [
                'color_id' => 6,
                'language' => 'ru',
                'title' => 'жёлтый',
            ],
            [
                'color_id' => 6,
                'language' => 'kk',
                'title' => 'сары',
            ],
            [
                'color_id' => 7,
                'language' => 'en',
                'title' => 'turquoise',
            ],
            [
                'color_id' => 7,
                'language' => 'ru',
                'title' => 'бирюзовый',
            ],
            [
                'color_id' => 7,
                'language' => 'kk',
                'title' => 'көгілдір',
            ],
            [
                'color_id' => 8,
                'language' => 'en',
                'title' => 'pink',
            ],
            [
                'color_id' => 8,
                'language' => 'ru',
                'title' => 'розовый',
            ],
            [
                'color_id' => 8,
                'language' => 'kk',
                'title' => 'қызғылт',
            ],
            [
                'color_id' => 9,
                'language' => 'en',
                'title' => 'light blue',
            ],
            [
                'color_id' => 9,
                'language' => 'ru',
                'title' => 'светло-голубое',
            ],
            [
                'color_id' => 9,
                'language' => 'kk',
                'title' => 'ашық көк',
            ],
            [
                'color_id' => 10,
                'language' => 'en',
                'title' => 'dark green',
            ],
            [
                'color_id' => 10,
                'language' => 'ru',
                'title' => 'темно-зеленый',
            ],
            [
                'color_id' => 10,
                'language' => 'kk',
                'title' => 'қою жасыл',
            ],
            [
                'color_id' => 11,
                'language' => 'en',
                'title' => 'red',
            ],
            [
                'color_id' => 11,
                'language' => 'ru',
                'title' => 'красный',
            ],
            [
                'color_id' => 11,
                'language' => 'kk',
                'title' => 'Қызыл',
            ],
            [
                'color_id' => 12,
                'language' => 'en',
                'title' => 'cream',
            ],
            [
                'color_id' => 12,
                'language' => 'ru',
                'title' => 'кремовый',
            ],
            [
                'color_id' => 12,
                'language' => 'kk',
                'title' => 'крем',
            ],
            [
                'color_id' => 13,
                'language' => 'en',
                'title' => 'темно-синий',
            ],
            [
                'color_id' => 13,
                'language' => 'ru',
                'title' => 'navy blue',
            ],
            [
                'color_id' => 13,
                'language' => 'kk',
                'title' => 'қара көк',
            ],
            [
                'color_id' => 14,
                'language' => 'en',
                'title' => 'голубой',
            ],
            [
                'color_id' => 14,
                'language' => 'ru',
                'title' => 'sky blue',
            ],
            [
                'color_id' => 14,
                'language' => 'kk',
                'title' => 'көгілдір',
            ],
        ];
        ColorTranslation::insert($colorsTranslations);
    }


    public function generateDress()
    {
        $dresses = [
            [
                'user_id' => 1,
                'photos' => ['evening/4-4.jpg', 'evening/4-1.jpg', 'evening/4-2.jpg', 'evening/4-3.jpg'],
                'categories' => [1],
                'sizes' => [1],
                'colors' => [1],
                'price' => 10000,
            ],
            [
                'user_id' => 1,
                'photos' => ['evening/16-1.jpg', 'evening/16-2.jpg', 'evening/16-3.jpg', 'evening/16-4.jpg', 'evening/16-5.jpg', 'evening/16-6.jpg'],
                'categories' => [1],
                'sizes' => [2],
                'colors' => [1, 2, 3, 4],
                'quantity' => 3,
                'price' => 15000,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Evening corset dress for hire (different colors) in Almaty',
                        'description' => 'Our famous tulle corset dresses fit perfectly. Lightweight and fluffy. Available in black, white, beige, purple, pink, raspberry (fuchsia) colors. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Size: 42-46 size is available in black, white, raspberry (fuchsia), light purple. Rental period: days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Вечернее платье-корсет на прокат (разные цвета) в Алматы',
                        'description' => 'Наши знаменитые фатиновые платья-корсеты идеально сидят по фигуре. Легкие и пышные. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: 42-46 размер есть в черном, белом, малиновом (фуксия), светло-фиолетовом цвете. Срок проката: сутки.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда кешкі корсет көйлек жалға беріледі (түрлі түсті).',
                        'description' => 'Біздің атақты тюль корсет көйлектеріміз тамаша жарасады. Жеңіл және жұмсақ. Қара, ақ, бежевый, күлгін, қызғылт, таңқурай (фуксия) түстері бар. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Өлшемі: 42-46 өлшемдері қара, ақ, таңқурай (фуксия), ашық күлгін түсті. Жалдау мерзімі: 24 сағат.',
                    ],
                ],
            ],
            [
                'user_id' => 1,
                'photos' => ['evening/5-1.jpg', 'evening/5-2.jpg', 'evening/5-3.jpg', 'evening/5-4.jpg', 'evening/5-5.jpg'],
                'categories' => [1],
                'sizes' => [1],
                'colors' => [5],
                'price' => 17000,
            ],
            [
                'user_id' => 1,
                'photos' => ['photosession/1-1.jpg', 'photosession/1-2.jpg', 'photosession/1-3.jpg', 'photosession/1-4.jpg', 'photosession/1-5.jpg'],
                'categories' => [2],
                'sizes' => [1],
                'colors' => [6],
                'price' => 25000,
            ],
            [
                'user_id' => 1,
                'photos' => ['photosession/6-1.jpg', 'photosession/6-2.jpg', 'photosession/6-3.jpeg', 'photosession/6-4.jpg', 'photosession/6-5.jpg'],
                'categories' => [2],
                'sizes' => [3],
                'colors' => [7],
                'price' => 35000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/2-1.jpg', 'uzatu/2-2.jpg', 'uzatu/2-3.jpg', 'uzatu/2-4.jpg', 'uzatu/2-5.jpg'],
                'categories' => [4],
                'sizes' => [2],
                'colors' => [8],
                'price' => 80000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/3-1.jpg', 'uzatu/3-2.jpg', 'uzatu/3-3.jpg', 'uzatu/3-4.jpg'],
                'categories' => [4],
                'sizes' => [2],
                'colors' => [9],
                'price' => 80000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/8-4.jpg', 'uzatu/8-1.jpg', 'uzatu/8-2.jpg', 'uzatu/8-3.jpg', 'uzatu/8-5.jpg'],
                'categories' => [4],
                'sizes' => [1],
                'colors' => [10],
                'price' => 80000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/11-1.jpg', 'uzatu/11-2.jpg', 'uzatu/11-3.jpg'],
                'categories' => [4],
                'sizes' => [2],
                'colors' => [11],
                'price' => 50000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/12-1.jpg', 'uzatu/12-2.jpg', 'uzatu/12-3.jpg'],
                'categories' => [4],
                'sizes' => [2],
                'colors' => [11],
                'price' => 50000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/13-3.jpg', 'uzatu/13-2.jpg', 'uzatu/13-1.jpg'],
                'categories' => [4, 6],
                'sizes' => [1],
                'colors' => [5, 7],
                'price' => 10000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/20-2.jpg', 'uzatu/19-2.jpg', 'uzatu/19-1.jpg', 'uzatu/19-3.jpg', 'uzatu/20-1.jpg', 'uzatu/20-3.jpg',],
                'categories' => [4],
                'sizes' => [],
                'colors' => [2],
                'price' => 4000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/12-3.jpg', 'uzatu/3-4.jpg', 'uzatu/11-1.jpg',],
                'categories' => [4],
                'sizes' => [],
                'price' => 10000,
                'colors' => [11],
            ],
            [
                'user_id' => 1,
                'price' => 3000,
                'photos' => ['uzatu/21-2.jpg', 'uzatu/21-1.jpg'],
                'categories' => [4, 6],
                'quantity' => 5,
            ],
            [
                'user_id' => 1,
                'price' => 15000,
                'photos' => ['national/kazakh/17-1.jpg', 'national/kazakh/17-2.jpg', 'national/kazakh/17-3.jpg'],
                'categories' => [6],
                'quantity' => 3,
                'sizes' => [2],
                'colors' => [4, 10],
            ],
            [
                'user_id' => 1,
                'price' => 15000,
                'photos' => ['national/kazakh/22-1.jpg', 'national/kazakh/22-2.jpg', 'national/kazakh/22-3.jpg'],
                'categories' => [6],
                'sizes' => [5],
                'colors' => [7],
            ],
            [
                'user_id' => 1,
                'price' => 20000,
                'photos' => ['national/kazakh/23-1.jpg', 'national/kazakh/23-2.jpg', 'national/kazakh/23-3.jpg'],
                'categories' => [6],
                'sizes' => [2],
                'colors' => [10],
            ],

            [
                'user_id' => 1,
                'photos' => ['evening/24-5.jpg', 'evening/24-6.jpg', 'evening/24-7.jpg', 'evening/24-12.jpg', 'evening/24-17.jpg'],
                'categories' => [1, 7],
                'sizes' => [2],
                'colors' => [1],
                'price' => 25000,
            ],
            [
                'user_id' => 1,
                'photos' => ['evening/25-4.jpg', 'evening/25-9.jpg', 'evening/25-10.jpg', 'evening/25-14.jpg', 'evening/25-15.jpg'],
                'categories' => [1, 7],
                'sizes' => [2],
                'colors' => [2],
                'price' => 35000,
            ],
            [
                'user_id' => 1,
                'photos' => ['evening/26-1.jpg', 'evening/26-2.jpg', 'evening/26-3.jpg', 'evening/26-4.jpg', 'evening/26-5.jpg'],
                'categories' => [1, 7],
                'sizes' => [1],
                'colors' => [2],
                'price' => 15000,
                'quantity' => 2
            ],
            [
                'user_id' => 1,
                'photos' => ['evening/27-7.jpg', 'evening/27-1.jpg', 'evening/27-2.jpg', 'evening/27-4.jpg', 'evening/27-12.jpg'],
                'categories' => [1, 7],
                'sizes' => [2],
                'colors' => [12],
                'price' => 20000,
            ],
            [
                'user_id' => 1,
                'photos' => ['evening/28-9.jpg', 'evening/28-1.jpg', 'evening/28-3.jpg', 'evening/28-18.jpg', 'evening/28-20.jpg'],
                'categories' => [1, 7],
                'sizes' => [2],
                'colors' => [4, 11],
                'price' => 25000,
                'quantity' => 2
            ],
            [
                'user_id' => 1,
                'photos' => ['muslim/29-4.jpg', 'muslim/29-3.jpg', 'muslim/29-5.jpg', 'muslim/29-6.jpg'],
                'categories' => [8],
                'sizes' => [2],
                'colors' => [13],
                'price' => 20000,
                'quantity' => 1
            ],
            [
                'user_id' => 1,
                'photos' => ['muslim/30-3.jpg', 'muslim/30-1.jpg', 'muslim/30-2.jpg'],
                'categories' => [8],
                'sizes' => [2],
                'colors' => [14],
                'price' => 20000,
                'quantity' => 1
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/31-1.jpg', 'uzatu/31-2.jpg', 'uzatu/31-3.jpg', 'uzatu/31-4.jpg', 'uzatu/31-5.jpg'],
                'categories' => [4, 6],
                'sizes' => [1],
                'colors' => [11],
                'price' => 150000,
                'quantity' => 1
            ],

            [
                'user_id' => 1,
                'photos' => ['bridal/32-1.jpg', 'bridal/32-2.jpg', 'bridal/32-3.jpg', 'bridal/32-4.jpg', 'bridal/32-5.jpg'],
                'categories' => [3],
                'sizes' => [1],
                'colors' => [2],
                'price' => 100000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'White fluffy wedding dress for rent in Almaty',
                        'description' => 'The white wedding dress is made of tulle and embroidered with beads. The skirt is fluffy and light, no ring required. The set includes a veil. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Белое пышное свадебное платье напрокат в Алматы',
                        'description' => 'Белое свадебное платье сшито из фатина, расшито бисером. Юбка пышная и легкая, кольцо не потребуется. В комплекте есть фата. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда ақ үлпілдек той көйлегі жалға беріледі',
                        'description' => 'Ақ той көйлегі тюльден тігілген және моншақтармен кестеленген. Юбка жұмсақ және жеңіл, сақина қажет емес. Жиынтыққа жамылғы кіреді. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['children/33-1.jpg', 'children/33-2.jpg', 'children/33-3.jpg', 'children/33-4.jpg'],
                'categories' => [9],
                'sizes' => [7],
                'colors' => [3],
                'price' => 7000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Lilac children`s ball gown for 10-12 years for rent in Almaty',
                        'description' => 'Lilac children`s ball gown made of tulle and satin, the lining is made of cotton fabric. The size is suitable for height 135-145, age 10-12 years. Rental period: 24 hours.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Сиреневое детское бальное платье на 10-12 лет напрокат в Алматы',
                        'description' => 'Сиреневое детское бальное платье из фатина и атласа, подклад сшит из х/б ткани. Размер подходит на рост 135-145, возраст 10-12 лет. Срок проката: сутки.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда 10-12 жылға сирень балаларға арналған бал көйлегі жалға беріледі',
                        'description' => 'Тюль мен атласты матадан тігілген сирень түсті балалар халаты, астары мақта матадан тігілген. Өлшемі 135-145 бойы, 10-12 жас аралығы үшін жарамды. Жалдау мерзімі: 24 сағат.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/34-1.jpg', 'uzatu/34-2.jpg', 'uzatu/34-3.jpg', 'uzatu/34-4.jpg', 'uzatu/34-5.jpg'],
                'categories' => [4],
                'sizes' => [1],
                'colors' => [10],
                'price' => 150000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Green velvet camisole for rent in Almaty',
                        'description' => 'The set includes a velvet camisole, takiya, saukele, tulle fluffy dress and jewelry. The camisole, taqiya and saukele are made of velvet and embroidered with hand-made patterns. The dress is made of tulle, the skirt is fluffy and there is no need for a ring. The top of the dress is a corset. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Зеленый бархатный камзол на узату напрокат в Алматы',
                        'description' => 'В комплект входит бархатный камзол, такия, саукеле, фатиновое пышное платье и украшения. Камзол, такия и саукеле сшиты из бархата и расшиты ручными узорами. Платье сшито из фатина, юбка пышная и не потребуется кольцо. Верх платья – корсет. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда жасыл барқыт камзол жалға беріледі',
                        'description' => 'Жиынтыққа барқыт камзол, тақия, сәукеле, тюльді үлпілдек көйлек және әшекей бұйымдар кіреді. Камзол, тақия, сәукеле барқыт матадан тігілген және қолдан өрнекпен кестеленген. Көйлек тюльден тігілген, белдемше үлпілдек, сақинаның қажеті жоқ. Көйлектің үстіңгі жағы - корсет. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['children/35-1.jpg', 'children/35-2.jpg', 'children/35-3.jpg'],
                'categories' => [9],
                'sizes' => [6],
                'colors' => [3],
                'price' => 7000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Lilac children`s ball gown for 8-10 years for rent in Almaty',
                        'description' => 'The lilac children`s ball gown is very delicate, made of tulle and satin. The size fits height 125-135. Rental period: 24 hours.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Сиреневое детское бальное платье на 8-10 лет напрокат в Алматы',
                        'description' => 'Сиреневое детское бальное платье очень нежное, сшито из фатина и атласа. Размер подходит на рост 125-135. Срок проката: сутки.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда 8-10 жылға сирень балаларға арналған бал көйлегі жалға беріледі',
                        'description' => 'Балаларға арналған сирень көйлегі өте нәзік, тюль мен атластан жасалған. Өлшемі 125-135 биіктікке сәйкес келеді. Жалдау мерзімі: 24 сағат.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/36-1.jpg', 'uzatu/36-2.jpg', 'uzatu/36-3.jpg', 'uzatu/36-4.jpg'],
                'categories' => [3, 4],
                'sizes' => [2],
                'colors' => [2],
                'price' => 35000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'White dress for wedding for rent in Almaty',
                        'description' => 'The white dress is made of chiffon. The tiara is completely hand-embroidered with beads, crystals and beads. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Белое платье на сырга салу напрокат в Алматы',
                        'description' => 'Белое платье сшито из шифона. Диадема полностью расшита вручную бисером, хрусталиками и бусами. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда сырға салуға арналған ақ көйлек жалға беріледі',
                        'description' => 'Ақ көйлек шифоннан тігілген. Тиара толығымен қолмен моншақтармен, кристалдармен және моншақтармен кестеленген. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/37-1.jpg', 'uzatu/37-2.jpg', 'uzatu/37-3.jpg', 'uzatu/37-4.jpg', 'uzatu/37-5.jpg'],
                'categories' => [4],
                'sizes' => [1],
                'colors' => [2],
                'price' => 50000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'White dress with camisole and saukele for rent in Almaty',
                        'description' => 'The dress is made of white chiffon. Camisole and saukele made of white satin, patterns are embroidered by hand, blue stones. The general set includes a dress, tiara, camisole, saukele with uki and veil. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Белое платье с камзолом и саукеле на узату напрокат в Алматы',
                        'description' => 'Белое платье сшито из белого шифона. Камзол и саукеле из белого атласа, узоры вышиты вручную, камни голубого цвета. В общий комплект входит платье, диадема, камзол, саукеле с үкі и фатой. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда камзол және сәукеле бар ақ көйлек жалға беріледі',
                        'description' => 'Көйлек ақ шифоннан тігілген. Ақ атластан камзол мен сәукеле, ою-өрнек қолдан кестеленген, көк тастар. Жалпы жиынтыққа көйлек, тақия, камзол, үкісі бар сәукеле және жамылғы кіреді. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['bridal/38-1.jpg', 'bridal/38-2.jpg', 'bridal/38-3.jpg'],
                'categories' => [3],
                'sizes' => [1],
                'colors' => [2],
                'price' => 100000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'White lace wedding dress for rent in Almaty',
                        'description' => 'The white lace wedding dress is made of tulle and satin. The sleeves, corset and skirt are hand-embroidered with Italian lace. The set includes a veil and a fluffy, comfortable petticoat without rings. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Белое кружевное свадебное платье напрокат в Алматы',
                        'description' => 'Белое кружевное свадебное платье сшито из фатина и атласа. Рукава, корсет и юбка вручную расшиты итальянским кружевом. В комплекте есть фата и пышный удобный подъюбник без колец. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда ақ шілтерлі той көйлегі жалға беріледі',
                        'description' => 'Ақ шілтерлі той көйлегі тюль мен атластан тігілген. Жеңдер, корсет және юбка итальяндық шілтермен қолдан кестеленген. Жиынтыққа жамылғы мен сақинасыз жұмсақ, ыңғайлы пальто кіреді. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/39-1.jpg', 'uzatu/39-2.jpg', 'uzatu/39-3.jpg', 'uzatu/39-4.jpg', 'uzatu/39-5.jpg'],
                'categories' => [4],
                'sizes' => [1],
                'colors' => [2],
                'price' => 50000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'White dress with a purple camisole and saukele for rent in Almaty',
                        'description' => 'The white dress is made of chiffon. The purple camisole is made of natural velvet and hand-embroidered with patterns. The saukele is made of satin and hand-embroidered with patterns; the set includes ukі and a veil. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Белое платье с фиолетовым камзолом и саукеле напрокат в Алматы',
                        'description' => 'Белое платье сшито из шифона. Фиолетовый камзол из натурального бархата и расшит вручную узорами. Саукеле сшито из атласа и расшито вручную узорами, в комплекте есть үкі и фата. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда күлгін камзол және сәукеле бар ақ көйлек жалға беріледі',
                        'description' => 'Ақ көйлек шифоннан тігілген. Күлгін камзол табиғи барқыттан тігілген, ою-өрнекпен қолдан кестеленген. Сәукеле атлас матадан тігілген және ою-өрнекпен қолдан кестеленген, жиынтықта үкі мен жамылғы бар. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/40-5.jpg', 'uzatu/40-1.jpg', 'uzatu/40-2.jpg', 'uzatu/40-3.jpg', 'uzatu/40-4.jpg'],
                'categories' => [4],
                'sizes' => [8],
                'colors' => [15],
                'price' => 70000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Blue camisole and dress for rent in Almaty',
                        'description' => 'The blue camisole is made of satin, long sleeves in oriental style. The blue dress is made of wedding satin. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Голубой камзол и платье на узату напрокат в Алматы',
                        'description' => 'Голубой камзол сшит из атласа, рукава длинные в восточном стиле. Голубое платье сшито из свадебного атласа. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда көк камзол мен көйлек жалға беріледі',
                        'description' => 'Көк камзол атласты, ұзын жеңді шығыс стилінде тігілген. Көк көйлек той атласынан тігілген. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['bridal/41-1.jpg', 'bridal/41-2.jpg', 'bridal/41-3.jpg', 'bridal/41-4.jpg', 'bridal/41-5.jpg'],
                'categories' => [3, 4],
                'sizes' => [1],
                'colors' => [2],
                'price' => 100000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Modern white dress with saukele on uzatu for rent in Almaty',
                        'description' => 'The set consists of a white dress in European style and a saukele. The headdress is low in shape and embroidered with crystals and beads. Saukele is issued with uki and veil. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Современное белое платье с саукеле на узату напрокат в Алматы',
                        'description' => 'Комплект состоит из белого платья в европейском стиле и саукеле. Головной убор невысокой формы и расшит хрусталиками и бисером. Саукеле выдается с үкі и фатой. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда ұзату үстінде сәукеле салынған заманауи ақ көйлек жалға беріледі',
                        'description' => 'Жиынтық еуропалық стильдегі ақ көйлек пен сәукеледен тұрады. Бас киімнің пішіні аласа, кристалдар мен моншақтармен кестеленген. Сәукеле үкі мен жамылғымен беріледі. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/42-1.jpg', 'uzatu/42-2.jpg', 'uzatu/42-3.jpg', 'uzatu/42-4.jpg', 'uzatu/42-5.jpg'],
                'categories' => [4],
                'sizes' => [1],
                'colors' => [8],
                'price' => 50000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Pink dress for sirga salu and uzata for rent in Almaty',
                        'description' => 'A pink dress with takiya is suitable for sirga sala. The dress is made of delicate chiffon and hand-embroidered with patterns. The white taqiya is made of satin and also embroidered with beads. The set includes a saukele, which can be worn on an uzata with a small number of guests. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Розовое платье на сырга салу и узату напрокат в Алматы',
                        'description' => 'Розовое платье с такия подходят на сырга салу. Платье сшито из нежного шифона и расшито вручную узорами. Белая такия сшита из атласа и также расшита бисером. В комплекте идет саукеле, который можно надеть на узату в кругу небольшого количества гостей. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда сырға салу мен ұзартуға арналған қызғылт көйлек жалға беріледі',
                        'description' => 'Сырға салаға тақиялы қызғылт көйлек жарасады. Көйлек нәзік шифоннан тігілген және ою-өрнекпен қолдан кестеленген. Ақ тақия атластан жасалған, сонымен қатар моншақтармен кестеленген. Жиынтықта сәукеле бар, оны қонақ саны аз болса, ұзата киюге болады. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['children/43-1.jpg', 'children/43-2.jpg', 'children/43-3.jpg', 'children/43-4.jpg', 'children/43-5.jpg'],
                'categories' => [9],
                'sizes' => [7],
                'colors' => [2],
                'price' => 10000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'White children`s ball gown for 10-12 years for rent in Almaty',
                        'description' => 'The white children`s dress is made of tulle and satin, lined with cotton fabric. The top of the dress is embroidered with flower petals. The size fits height 135-145. Rental period: 24 hours.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Белое детское бальное платье на 10-12 лет напрокат в Алматы',
                        'description' => 'Белое детское платье сшито из фатина и атласа, подклад из х/б ткани. Верх платья расшито цветочными лепестками. Размер подходит на рост 135-145. Срок проката: сутки.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда 10-12 жылға балаларға арналған ақ халат жалға беріледі',
                        'description' => 'Балалардың ақ көйлегі тюль мен атластан тігілген, астары мақта матамен қапталған. Көйлектің үстіңгі жағы гүл жапырақшаларымен кестеленген. Өлшемі 135-145 биіктікке сәйкес келеді. Жалдау мерзімі: 24 сағат.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['children/44-1.jpg', 'children/44-2.jpg', 'children/44-3.jpg', 'children/44-4.jpg'],
                'categories' => [9],
                'sizes' => [6],
                'colors' => [2],
                'price' => 10000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'White children`s ball gown for 8-10 years for rent in Almaty',
                        'description' => 'The white children`s dress is made of tulle and satin. The top of the dress is elasticated, the hem of the skirt is finished with fishing line. The size fits height 125-135. Rental period: 24 hours.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Белое детское бальное платье на 8-10 лет напрокат в Алматы',
                        'description' => 'Белое детское платье сшито из фатина и атласа. Верх платья на резинке, подол юбки обработан леской. Размер подходит на рост 125-135. Срок проката: сутки.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда 8-10 жылға балаларға арналған ақ халат жалға беріледі',
                        'description' => 'Балалардың ақ көйлегі тюль мен атластан тігілген. Көйлектің үстіңгі жағы серпімді, белдемшенің етегі балық аулау жолымен аяқталады. Өлшемі 125-135 биіктікке сәйкес келеді. Жалдау мерзімі: 24 сағат.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/45-1.jpg', 'uzatu/45-2.jpg', 'uzatu/45-3.jpg', 'uzatu/45-4.jpg', 'uzatu/45-5.jpg'],
                'categories' => [3, 4],
                'sizes' => [1],
                'colors' => [8],
                'price' => 150000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Pink dress with saukele and veil for rent in Almaty',
                        'description' => 'One of the luxury kits for uzatu. The dress is made of organza and hand-embroidered with beads. The skirt has a removable fluffy train. The camisole, taqiya, and saukele are hand-embroidered with patterns. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Розовое платье с саукеле и фатой на узату напрокат в Алматы',
                        'description' => 'Один из люксовых комплектов для узату. Платье сшито из органзы и расшито вручную бисером. На юбке есть съемный пышный шлейф. Камзол, такия, саукеле расшиты вручную узорами. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда сәукеле мен жамылғы бар қызғылт көйлек жалға беріледі',
                        'description' => 'Ұзатуға арналған сәнді жиынтықтардың бірі. Көйлек органзадан тігілген және моншақтармен қолдан кестеленген. Юбкада алынбалы пушистый пойыз бар. Камзол, тақия, сәукеле ою-өрнекпен қолдан кестеленген. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['evening/46-5.jpg', 'evening/46-1.jpg', 'evening/46-2.jpg', 'evening/46-3.jpg', 'evening/46-5.jpg'],
                'categories' => [1],
                'sizes' => [2],
                'colors' => [8],
                'price' => 15000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Light pink evening dress for rent in Almaty',
                        'description' => 'Light pink (in poor light it has a light lilac tint) dress with long puff sleeves and a full French-length skirt. Fabric – tulle with polka dots. Rental period: 24 hours.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Светло-розовое вечернее платье напрокат в Алматы',
                        'description' => 'Светло-розовое (при плохом свете имеет светло-сиреневый оттенок) платье с длинными рукавами-фонарик и пышной юбкой французской длины. Ткань – фатин в горошек. Срок проката: сутки.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда ашық қызғылт кешкі көйлек жалға беріледі',
                        'description' => 'Ашық қызғылт түсті (нашар жарықта ол ашық сирень реңкіне ие) ұзын жеңдері бар және толық француз юбкасымен көйлек. Мата – полка нүктелері бар тюль. Жалдау мерзімі: 24 сағат.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['children/47-1.jpg', 'children/47-2.jpg', 'children/47-3.jpg', 'children/47-4.jpg'],
                'categories' => [9],
                'sizes' => [9],
                'colors' => [11],
                'price' => 15000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Hot pink Barbie style children`s dress for rent in Almaty',
                        'description' => 'A hot pink Barbie style baby dress is made of hot pink tulle. The top is a corset, the skirt is fluffy. The size is suitable for height 145-160. Rental period: 24 hours.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Ярко-розовое детское платье в стиле Барби напрокат в Алматы',
                        'description' => 'Ярко-розовое детское платье в стиле Барби сшито из ярко-розового фатина. Верх корсет, юбка пышная. Размер подходит на рост 145-160. Срок проката: сутки.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда ыстық қызғылт Барби стиліндегі балалар көйлегі жалға беріледі',
                        'description' => 'Ыстық қызғылт Барби стиліндегі нәресте көйлегі қызғылт түсті тюльден жасалған. Үсті – корсет, белдемше – үлпілдек. Өлшемі 145-160 биіктікке сәйкес келеді. Жалдау мерзімі: 24 сағат.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/7-2.jpg', 'uzatu/7-1.jpg', 'uzatu/7-3.jpg'],
                'categories' => [4,3],
                'sizes' => [2],
                'colors' => [10],
                'price' => 10000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Green dress for bridesmaids for rent in Almaty',
                        'description' => 'Green dress made of luxury quality wedding satin. The belt is tied at the back. The size is adjusted to fit the figure. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Зеленое платье для подружки невесты напрокат в Алматы',
                        'description' => 'Зеленое платье из свадебного атласа люкс качества. Пояс завязывается сзади. Размер подгоняется по фигуре. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда қыз ұзатуға арналған жасыл көйлек жалға беріледі',
                        'description' => 'Сәнді сапалы үйлену тойына арналған сатиннен жасалған жасыл көйлек. Белдік артқы жағынан байланған. Өлшем фигураға сәйкес келетіндей етіп реттеледі. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/9-3.jpg', 'uzatu/9-1.jpg', 'uzatu/9-2.jpg', 'uzatu/9-4.jpg'],
                'categories' => [4,3],
                'sizes' => [2],
                'colors' => [2],
                'price' => 10000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'White dress for bridesmaids for rent in Almaty',
                        'description' => 'White dress made of luxury quality wedding satin. The belt is tied at the back. The size is adjusted to fit the figure. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Белое платье для подружки невесты напрокат в Алматы',
                        'description' => 'Белое платье из свадебного атласа люкс качества. Пояс завязывается сзади. Размер подгоняется по фигуре. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда қыз ұзатуға арналған ақ көйлек жалға беріледі',
                        'description' => 'Сәнді сапалы үйлену тойына арналған сатиннен жасалған ақ көйлек. Белдік артқы жағынан байланған. Өлшем фигураға сәйкес келетіндей етіп реттеледі. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['uzatu/10-5.jpg', 'uzatu/10-3.jpg', 'uzatu/10-4.jpg'],
                'categories' => [4,3],
                'sizes' => [2],
                'colors' => [8],
                'price' => 10000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Pink dress for bridesmaids for rent in Almaty',
                        'description' => 'Pink dress made of luxury quality wedding satin. The belt is tied at the back. The size is adjusted to fit the figure. Rental period: 3 days.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Розовое платье для подружки невесты напрокат в Алматы',
                        'description' => 'Ярко-розовое платье в стиле сшито из ярко-розового фатина. Верх корсет, юбка пышная. Размер подходит на рост 145-160. Срок проката: 3 дня.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда қыз ұзатуға арналған қызғылт көйлек жалға беріледі',
                        'description' => 'Сәнді сапалы үйлену тойына арналған сатиннен жасалған қызғылт көйлек. Белдік артқы жағынан байланған. Өлшем фигураға сәйкес келетіндей етіп реттеледі. Жалдау мерзімі: 3 күн.',
                    ],
                ]
            ],

            [
                'user_id' => 1,
                'photos' => ['national/kazakh/48-5.jpg', 'national/kazakh/48-2.jpg', 'national/kazakh/48-3.jpg', 'national/kazakh/48-4.jpg', 'national/kazakh/48-1.jpg'],
                'categories' => [6],
                'sizes' => [5],
                'colors' => [7],
                'price' => 15000,
                'quantity' => 1,
                'translations' => [
                    [
                        'language' => 'en',
                        'title' => 'Women`s national turquoise ethnic set for rent in Almaty',
                        'description' => 'Turquoise (mint) national women`s ethnic set. The set includes a basic dress, shapan and taqiya. The design was developed by fashion designer Aliya Musaeva from ApoltiStore. Rental period: 24 hours.',
                    ],
                    [
                        'language' => 'ru',
                        'title' => 'Бирюзовый женский национальный этно-комплект напрокат в Алматы',
                        'description' => 'Бирюзовый (мятный) национальный женский этно-комплект. В комплект входит базовое платье, шапан и такия. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Срок проката: сутки.',
                    ],
                    [
                        'language' => 'kk',
                        'title' => 'Алматыда әйелдерге арналған ұлттық көгілдір этникалық жиынтық жалға беріледі',
                        'description' => 'Бірюза (жалбыз) ұлттық әйелдер этникалық жиынтығы. Жиынтықта негізгі көйлек, шапан және тақия бар. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева әзірлеген. Жалдау мерзімі: 24 сағат.',
                    ],
                ]

            ],

        ];

        $dressesPhoto = [];
        foreach ($dresses as $dress) {
            $photos = $dress['photos'] ?? [];
            $categories = $dress['categories'] ?? [];
            $sizes = $dress['sizes'] ?? [];
            $colors = $dress['colors'] ?? [];
            $prices = $dress['price'];
            $translations = $dress['translations'] ?? [];
            unset($dress['photos']);
            unset($dress['categories']);
            unset($dress['sizes']);
            unset($dress['colors']);
            unset($dress['price']);
            unset($dress['translations']);


            $newDress = Dress::create(
                [
                    ...$dress,
                    ...[
                        'updated_at' => now(),
                        'created_at' => now(),
                    ],
                ]
            );

            foreach ($translations as &$translation)
                $translation = [
                    'dress_id' => $newDress->dress_id,
                    ...$translation
                ];
            DressTranslation::insert($translations);

            $newDress->category()->attach($categories);
            $newDress->size()->attach($sizes);
            $newDress->color()->attach($colors);

            DressPrice::create([
                'dress_id' => $newDress->dress_id,
                'code' => 'KZT',
                'price' => $prices,
            ]);

            foreach ($photos as $photo)
                $dressesPhoto[] = [
                    'dress_id' => $newDress->dress_id,
                    'image' => $photo
                ];

        }

        if (count($dressesPhoto))
            Photo::insert($dressesPhoto);

    }

    public function generateDressTranslation()
    {
        $dressesTranslations = [
            [
                'dress_id' => 1,
                'language' => 'en',
                'title' => 'Evening black velvet dress for rent in Almaty',
                'description' => 'Little velvet black French length dress. The flounces of the dress are embroidered with pearls. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Rental period: day.',
            ],
            [
                'dress_id' => 1,
                'language' => 'ru',
                'title' => 'Вечернее черное платье из бархата на прокат в Алматы',
                'description' => 'Маленькое бархатное черное платье французской длины. Воланы платья расшиты жемчужинами. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Срок проката: сутки.',
            ],
            [
                'dress_id' => 1,
                'language' => 'kk',
                'title' => 'Алматыда кешкі қара барқыт көйлек жалға беріледі',
                'description' => 'Кішкене барқыт қара француз ұзын көйлек. Көйлектің желбезегі інжу-маржанмен кестеленген. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Жалдау мерзімі: 24 сағат.',
            ],

            [
                'dress_id' => 3,
                'language' => 'en',
                'title' => 'Evening purple long dress for rent in Almaty',
                'description' => 'Bright evening purple long dress. The dress is embroidered by the author, the design was developed by fashion designer Aliya Musayeva from ApoltiStore. Rental period: days.',
            ],
            [
                'dress_id' => 3,
                'language' => 'ru',
                'title' => 'Вечернее фиолетовое длинное платье на прокат в Алматы',
                'description' => 'Яркое вечернее фиолетовое длинное платье. Вышивка платья авторская, дизайн разработан модельером Алией Мусаевой из ApoltiStore. Срок проката: сутки.',
            ],
            [
                'dress_id' => 3,
                'language' => 'kk',
                'title' => 'Алматыда кешкі күлгін ұзын көйлек жалға беріледі',
                'description' => 'Ашық кешкі күлгін ұзын көйлек. Көйлекті автор кестелеген, дизайнын ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Жалдау мерзімі: 24 сағат.',
            ],
            [
                'dress_id' => 4,
                'language' => 'en',
                'title' => 'Evening yellow dress with a train for a photo shoot for rent in Almaty',
                'description' => 'A yellow tulle dress with a 3 meter train is perfect for a photo shoot, love story. The dress is light, designed by fashion designer Aliya Musayeva from ApoltiStore. Rental period: days.',
            ],
            [
                'dress_id' => 4,
                'language' => 'ru',
                'title' => 'Вечернее желтое платье со шлейфом на фотосессию на прокат в Алматы',
                'description' => 'Желтое фатиновое платье с 3 метровым шлейфом отлично подойдет для фотосессии, love story. Платье лекое, дизайн разработан модельером Алией Мусаевой из ApoltiStore. Срок проката: сутки.',
            ],
            [
                'dress_id' => 4,
                'language' => 'kk',
                'title' => 'Алматыда фотосессияға арналған пойызбен кешкі сары көйлек жалға беріледі',
                'description' => '3 метр пойызы бар сары тюль көйлек фотосессияға, махаббат хикаясына өте ыңғайлы. Көйлек жеңіл, оны ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Жалдау мерзімі: 24 сағат.',
            ],
            [
                'dress_id' => 5,
                'language' => 'en',
                'title' => 'Family look Family look for mom and daughter dresses for a photo shoot for rent in Almaty',
                'description' => 'Tulle dresses for mother and daughter are designed to create family bows, festive photo shoots. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Size: adult - 42-48, child - for size 98-116 cm.',
            ],
            [
                'dress_id' => 5,
                'language' => 'ru',
                'title' => 'Фэмили лук Family look для мамы и дочки платья на фотосессию на прокат в Алматы',
                'description' => 'Фатиновые платья для мамы и дочки предназначены для создания семейных луков, праздничных фотосессией. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: взрослое - 42-48, детское - для ростовки 98-116 см.',
            ],
            [
                'dress_id' => 5,
                'language' => 'kk',
                'title' => 'Отбасылық көрініс Алматыда фотосессияға анасы мен қызына арналған көйлектер жалға беріледі',
                'description' => 'Анасы мен қызына арналған тюль көйлектері отбасылық садақтарды, мерекелік фотосессияларды жасауға арналған. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Өлшемі: ересек - 42-48, бала - 98-116 см өлшемі үшін.',
            ],
            [
                'dress_id' => 6,
                'language' => 'en',
                'title' => 'Pink dress with tie for rent (set) in Almaty',
                'description' => 'Delicate set for uzatu in the color of a dusty rose. All patterns are hand-embroidered, designed by Aliya Musaeva from ApoltiStore. The set includes a light fluffy dress without a ring, a long camisole, saukele, diadem. Each bride is given a new veil and bows as a gift. Rental period: 3 days.',
            ],
            [
                'dress_id' => 6,
                'language' => 'ru',
                'title' => 'Розовое платье на узату на прокат (комплект) в Алматы',
                'description' => 'Нежный комплект для узату в цвете пыльной розы. Все узоры вышиты вручную, дизайн разработан модельером Алией Мусаевой из ApoltiStore. В комплект входит легкое пышное платье без кольца, длинный камзол, саукеле, диадема. Для каждой невесты в подарок новая фата и уки. Срок проката: 3 дня.',
            ],
            [
                'dress_id' => 6,
                'language' => 'kk',
                'title' => 'Алматыда жалға алу галстук бар қызғылт көйлек (жиынтық).',
                'description' => 'Шаңды раушан гүлінің түсінде ұзатуға арналған нәзік жиынтық. Барлық үлгілер қолдан кестеленген, оны ApoltiStore дүкенінен Әлия Мұсаева әзірлеген. Жиынтыққа сақинасыз жеңіл үлпілдек көйлек, ұзын камзол, сәукеле, диадема кіреді. Әр келінге жаңа орамал мен бантик сыйлайды. Жалдау мерзімі: 3 күн.',
            ],
            [
                'dress_id' => 7,
                'language' => 'en',
                'title' => 'Blue dress with tie for rent (set) in Almaty',
                'description' => 'Set for uzatu in blue. All patterns are hand-embroidered, designed by Aliya Musaeva from ApoltiStore. The set includes a light fluffy dress without a ring, a long camisole, saukele, takiya and a diadem. Each bride is given a new veil and bows as a gift. Rental period: 3 days.',
            ],
            [
                'dress_id' => 7,
                'language' => 'ru',
                'title' => 'Голубое платье на узату на прокат (комплект) в Алматы',
                'description' => 'Комплект для узату в голубом цвете. Все узоры вышиты вручную, дизайн разработан модельером Алией Мусаевой из ApoltiStore. В комплект входит легкое пышное платье без кольца, длинный камзол, саукеле, такия и диадема. Для каждой невесты в подарок новая фата и уки. Срок проката: 3 дня.',
            ],
            [
                'dress_id' => 7,
                'language' => 'kk',
                'title' => 'Алматыда жалдамалы галстук бар көк көйлек (жиынтық).',
                'description' => 'Көк түсте ұзатуға арналған жиынтық. Барлық үлгілер қолдан кестеленген, оны ApoltiStore дүкенінен Әлия Мұсаева әзірлеген. Жиынтыққа сақинасыз жеңіл үлпілдек көйлек, ұзын камзол, сәукеле, тақия және диадема кіреді. Әр келінге жаңа орамал мен бантик сыйлайды. Жалдау мерзімі: 3 күн.',
            ],
            [
                'dress_id' => 8,
                'language' => 'en',
                'title' => 'Uzbek wedding dress with knot for rent in Almaty',
                'description' => 'This set was specially made for the Uzbek bride. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. The camisole is embroidered with lace, the tiara is hand-embroidered with crystals and beads. The complex includes a light dress made of delicate satin, a long camisole and a diadem. Rental period: 3 days.',
            ],
            [
                'dress_id' => 8,
                'language' => 'ru',
                'title' => 'Узбекское свадебное платье на узату на прокат в Алматы',
                'description' => 'Этот комплект был специально сшит для узбекской невесты. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Камзол расшит кружевом, диадема вышита вручную хрусталиками и бисером. В комплекс входит легкое платье из нежного атласа, длинный камзол и диадема. Срок проката: 3 дня.',
            ],
            [
                'dress_id' => 8,
                'language' => 'kk',
                'title' => 'Алматыда түйіні бар өзбек той көйлегі жалға беріледі',
                'description' => 'Бұл жиынтық өзбек келіні үшін арнайы жасалған. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Камзол шілтер, тақия кристалдар мен моншақтармен қолдан кестеленген. Кешенге нәзік атластан тігілген жеңіл көйлек, ұзын камзол және диадема кіреді. Жалдау мерзімі: 3 күн.',
            ],
            [
                'dress_id' => 9,
                'language' => 'en',
                'title' => 'Red dress for rent (set) in Almaty',
                'description' => 'Set for uzatu in red. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. All patterns are embroidered by hand. The set includes a light satin dress, a long camisole with a belt, saukele. Each bride is given a new veil and bows as a gift. Rental period: 3 days.',
            ],
            [
                'dress_id' => 9,
                'language' => 'ru',
                'title' => 'Красное платье на узату на прокат (комплект) в Алматы',
                'description' => 'Комплект для узату в красном цвете. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Все узоры вышиты вручную. В комплект входит легкое платье из атласа, длинный камзол с поясом, саукеле. Для каждой невесты в подарок новая фата и уки. Срок проката: 3 дня.',
            ],
            [
                'dress_id' => 9,
                'language' => 'kk',
                'title' => 'Алматыда қызыл көйлек жалға беріледі (набор).',
                'description' => 'Қызыл түсте ұзатуға арналған жиынтық. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Барлық үлгілер қолмен кестеленген. Жиынтықта жеңіл атласты көйлек, белбеуі бар ұзын камзол, сәукеле бар. Әр келінге жаңа орамал мен бантик сыйлайды. Жалдау мерзімі: 3 күн.',
            ],
            [
                'dress_id' => 10,
                'language' => 'en',
                'title' => 'Red dress with tulip patterns for rent (set) in Almaty',
                'description' => 'This red set with tulip patterns is one of the most popular for uzatus. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. All patterns are embroidered by hand. The set includes a light satin dress, a long camisole with a train, saukele and takiya. For each bride as a gift a new veil and feathers. Rental period: 3 days.',
            ],
            [
                'dress_id' => 10,
                'language' => 'ru',
                'title' => 'Красное платья на узату с узорами из тюльпанов на прокат (комплект) в Алматы',
                'description' => 'Этот красный комплект с узорами в виде тюльпанов является одним из популярных для узату. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Все узоры вышиты вручную. В комплект входит легкое платье из атласа, длинный камзол со шлейфом, саукеле и такия. Для каждой невесты в подарок новая фата и перья укі. Срок проката: 3 дня.',
            ],
            [
                'dress_id' => 10,
                'language' => 'kk',
                'title' => 'Алматыда қызғалдақ өрнекті қызыл көйлек жалға (жиынтық).',
                'description' => 'Қызғалдақ өрнектері бар бұл қызыл жиынтық ұзартуға арналған ең танымалдардың бірі. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Барлық үлгілер қолмен кестеленген. Жиынтықта жеңіл атласты көйлек, пойызбен ұзын камзол, сәукеле және тақия бар. Әр қалыңдыққа сыйлық ретінде жаңа орамал мен қауырсын. Жалдау мерзімі: 3 күн.',
            ],
            [
                'dress_id' => 11,
                'language' => 'en',
                'title' => 'Short camisole for rent in Almaty',
                'description' => "Short camisoles with handmade author's embroidery. The design and patterns of each camisole are developed by fashion designer Aliya Musayeva from ApoltiStore, Saukele&Kamzol. Size: 42-44. Colors: purple, turquoise, black, pink.",
            ],
            [
                "dress_id" => 11,
                'language' => 'ru',
                'title' => 'Короткий камзол на прокат в Алматы',
                'description' => 'Короткие камзолы с ручной авторской вышивкой. Дизайн и узоры каждого камзола разрабатываются модельером Алией Мусаевой из ApoltiStore, Saukele&Kamzol. Размер: 42-44. Цвета: фиолетовый, бирюзовый, черный, розовый.',
            ],
            [
                'dress_id' => 11,
                'language' => 'kk',
                'title' => 'Алматыда жалдамалы қысқа камзол',
                'description' => 'Қолмен жасалған авторлық кестелері бар қысқа камзолдар. Әр камзолдың дизайны мен өрнектерін ApoltiStore, Saukele&Kamzol дүкендерінің сәнгері Әлия Мұсаева әзірлеген. Өлшемі: 42-44. Түстер: күлгін, көгілдір, қара, қызғылт.',
            ],
            [
                'dress_id' => 12,
                'language' => 'en',
                'title' => 'Veil and uki feathers for rent',
                'description' => 'Each bride who rents a set for uzatu will receive a new veil and feathers (uki) as a gift. You can also buy a veil and feathers (uki) separately.',
            ],
            [
                'dress_id' => 12,
                'language' => 'ru',
                'title' => 'Фата и перья уки на узату на прокат',
                'description' => 'Каждой невесте, которая возьмет напрокат комплект для узату, новые фата и перья (укі) выдаются в качестве подарка. Также можно отдельно купить фату и перья (укі).',
            ],
            [
                'dress_id' => 12,
                'language' => 'kk',
                'title' => 'Фата мен уки қауырсындары жалға беріледі',
                'description' => 'Ұзақуға арналған жиынтықты жалға алған әрбір келіншек сыйлыққа жаңа орамал мен қауырсын (уки) алады. Сондай-ақ, перде мен қауырсындарды (уки) бөлек сатып алуға болады.',
            ],
            [
                'dress_id' => 13,
                'language' => 'en',
                'title' => 'Saukele for rent',
                'description' => 'Our craftsmen make light and beautiful saukeles. The design and patterns of each saukele are developed by fashion designer Aliya Musayeva from ApoltiStore, Saukele&Kamzol. Rental price: red - 10,000t, blue and pink - 20,000t. Rental period: from 1 day to 3-5 days.',
            ],
            [
                'dress_id' => 13,
                'language' => 'ru',
                'title' => 'Саукеле на узату на прокат',
                'description' => 'Наши мастера делают легкие и красивые саукеле. Дизайн и узоры каждого саукеле разрабатываются модельером Алией Мусаевой из ApoltiStore, Saukele&Kamzol. Цена проката: красное - 10 000т, голубое и розовое - 20 000т. Срок проката: от 1 дня до 3-5 дней.',
            ],
            [
                'dress_id' => 13,
                'language' => 'kk',
                'title' => 'Саукеле қосулы узату жалдауға',
                'description' => 'Біздің шеберлер жеңіл әрі әдемі сәукеле жасайды. Әр сәукеленің дизайны мен өрнектерін ApoltiStore, Saukele&Kamzol дүкендерінің сәнгері Әлия Мұсаева әзірлеген. Жалдау бағасы: қызыл – 10 000т, көк және қызғылт – 20 000т. Жалдау мерзімі: 1 күннен 3-5 күнге дейін.',
            ],
            [
                'dress_id' => 14,
                'language' => 'en',
                'title' => 'National ornaments for rent',
                'description' => 'We have sets of national decorations that you can rent. There are earrings, besbilezik, bracelets and a necklace (alqa). Rental price: from 3000 tenge. Rental period: from 1 day to 3-5 days.',
            ],
            [
                'dress_id' => 14,
                'language' => 'ru',
                'title' => 'Национальные украшения на узату на прокат',
                'description' => 'У нас есть комплекты национальных украшений, которые можно взять напрокат. Есть серьги, бесбилезик, браслеты и ожерелье (алқа). Цена проката: от 3000 тенге. Срок проката: от 1 дня до 3-5 дней.',
            ],
            [
                'dress_id' => 14,
                'language' => 'kk',
                'title' => 'Ұлттық ою-өрнектер жалға беріледі',
                'description' => 'Бізде ұлттық әшекейлер жиынтығы бар, оларды жалға алуға болады. Сырға, бесбілезік, білезік, алқа (алқа) бар. Жалдау бағасы: 3000 теңгеден бастап. Жалдау мерзімі: 1 күннен 3-5 күнге дейін.',
            ],
            [
                'dress_id' => 15,
                'language' => 'en',
                'title' => "Women's national ethnic costume for rent in Almaty",
                'description' => "Light women's ethno-sets in different colors. There is blue, dark turquoise, fuchsia and dark green. Includes base dress, hat and takiya. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Size: 42-46. Rental period: day",
            ],
            [
                'dress_id' => 15,
                'language' => 'ru',
                'title' => 'Женский национальный этно-костюм на прокат в Алматы',
                'description' => 'Легкие женские этно-комплекты в разных цветах. Есть голубой, темно-бирюзовый, в цвете фуксии и тёмно-зелёный. В комплект входит базовое платье, шапан и такия. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: 42-46. Срок проката: сутки',
            ],
            [
                'dress_id' => 15,
                'language' => 'kk',
                'title' => 'Алматыда әйелдердің ұлттық этникалық киімі жалға беріледі',
                'description' => 'Түрлі түстердегі жеңіл әйелдер этно-жиынтықтары. Көк, қара көгілдір, фуксия және қою жасыл түсті. Негізгі көйлек, қалпақ және такия кіреді. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Өлшемі: 42-46. Жалдау мерзімі: 24 сағат.',
            ],
            [
                'dress_id' => 16,
                'language' => 'en',
                'title' => "Women`s national blue ethnic costume for rent in Almaty",
                'description' => "Light women`s ethno-sets in different colors. There is blue, dark turquoise, fuchsia and dark green. Includes base dress, hat and takiya. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Size: 42-52. Rental period: day",
            ],
            [
                'dress_id' => 16,
                'language' => 'ru',
                'title' => 'Женский национальный голубой этно-костюм на прокат в Алматы',
                'description' => 'Легкие женские этно-комплекты в разных цветах. Есть голубой, темно-бирюзовый, в цвете фуксии и тёмно-зелёный. В комплект входит базовое платье, шапан и такия. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: 42-52. Срок проката: сутки',
            ],
            [
                'dress_id' => 16,
                'language' => 'kk',
                'title' => 'Алматыда әйелдерге арналған ұлттық көгілдір этникалық киім жалға беріледі',
                'description' => 'Түрлі түстердегі жеңіл әйелдер этно-жиынтықтары. Көк, қара көгілдір, фуксия және қою жасыл түсті. Негізгі көйлек, қалпақ және такия кіреді. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Өлшемі: 42-52. Жалдау мерзімі: 24 сағат.',
            ],
            [
                'dress_id' => 17,
                'language' => 'en',
                'title' => "Women`s national dark green ethnic costume for rent in Almaty",
                'description' => "Light women`s ethno-sets in different colors. There is blue, dark turquoise, fuchsia and dark green. Includes base dress, hat and takiya. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Size: 42-46. Rental period: day",
            ],
            [
                'dress_id' => 17,
                'language' => 'ru',
                'title' => 'Женский национальный тёмно-зелёный этно-костюм на прокат в Алматы',
                'description' => 'Легкие женские этно-комплекты в разных цветах. Есть голубой, темно-бирюзовый,в цвете фуксии и тёмно-зелёный. В комплект входит базовое платье, шапан и такия. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: 42-46. Срок проката: сутки',
            ],
            [
                'dress_id' => 17,
                'language' => 'kk',
                'title' => 'Алматыда әйелдердің ұлттық қара-жасыл этникалық костюмі жалға беріледі',
                'description' => 'Түрлі түстердегі жеңіл әйелдер этно-жиынтықтары. Көк, қара көгілдір, фуксия және қою жасыл түсті. Негізгі көйлек, қалпақ және такия кіреді. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Өлшемі: 42-46. Жалдау мерзімі: 24 сағат.',
            ],
            [
                'dress_id' => 18,
                'language' => 'en',
                'title' => 'Evening black dress with a slit for rent in Almaty',
                'description' => 'Long black evening dress. Asymmetrical top, slit skirt. The dress can be worn with a white ruffle or with long gloves. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Rental period: day.',
            ],
            [
                'dress_id' => 18,
                'language' => 'ru',
                'title' => 'Вечернее черное платье с разрезом на прокат в Алматы',
                'description' => 'Длинное черное вечернее платье. Асимметричный верх, юбка с разрезом. Платье можно носить с белым воланом или с длинными перчатками. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Срок проката: сутки.',
            ],
            [
                'dress_id' => 18,
                'language' => 'kk',
                'title' => 'Алматыда саңылауы бар кешкі қара көйлек жалға беріледі',
                'description' => 'Ұзын қара кешкі көйлек. Асимметриялы үстіңгі, тігілген юбка. Көйлекті ақ бөртпемен немесе ұзын қолғаппен киюге болады. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Жалдау мерзімі: 24 сағат.',
            ],
            [
                'dress_id' => 19,
                'language' => 'en',
                'title' => 'Romantic ivory dress for rent in Almaty',
                'description' => 'Ivory dress with full skirt and detachable puffed sleeves. The dress can be worn with oxen, with sleeves or gloves. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Rental period: day.',
            ],
            [
                'dress_id' => 19,
                'language' => 'ru',
                'title' => 'Романтичное платье цвета айвори на прокат в Алматы',
                'description' => 'Айвори платье с пышной юбкой и съемными пышными рукавами. Платье можно надеть с волами, с рукавами или перчатками. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Срок проката: сутки.',
            ],
            [
                'dress_id' => 19,
                'language' => 'kk',
                'title' => 'Алматыда романтикалық айвори түсті ұзын көйлек жалға беріледі',
                'description' => 'Айвори түсті ұзын көйлек. Етегі төгіліп тұрады, жеңдері шешіледі. Дизайн ApoltiStore дүкенінің сәнгері Әлия Мұсаеванікі. Жалдау мерзімі: 24 сағат.',
            ],
            [
                'dress_id' => 20,
                'language' => 'en',
                'title' => 'Short white dress in Jenny style for rent in Almaty',
                'description' => 'Short white dress with black belt and black gloves. Jennie from BlackPink. Rental period: day.',
            ],
            [
                'dress_id' => 20,
                'language' => 'ru',
                'title' => 'Короткое белое платье в стиле Дженни на прокат в Алматы',
                'description' => 'Короткое белое платье с черным поясом и черными перчатками. Образ Дженни из BlackPink. Срок проката: сутки.',
            ],
            [
                'dress_id' => 20,
                'language' => 'kk',
                'title' => 'Алматыда Дженни стиліндегі қысқа ақ көйлек жалға беріледі',
                'description' => 'Қара белдік пен қара қолғапты қысқа ақ көйлек. BlackPink-тен Дженни. Жалдау мерзімі: 24 сағат.',
            ],
            [
                'dress_id' => 21,
                'language' => 'en',
                'title' => 'Romantic pink long dress in Korean style for rent in Almaty',
                'description' => 'Romantic pink long dress with a bow. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Rental period: day.',
            ],
            [
                'dress_id' => 21,
                'language' => 'ru',
                'title' => 'Романтичное розовое длинное платье в корейском стиле на прокат в Алматы',
                'description' => 'Романтичное розовое длинное платье с бантом. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Срок проката: сутки.',
            ],
            [
                'dress_id' => 21,
                'language' => 'kk',
                'title' => 'Алматыда корей стиліндегі романтикалық қызғылт ұзын көйлек жалға беріледі',
                'description' => 'Садақпен романтикалық қызғылт ұзын көйлек. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Жалдау мерзімі: 24 сағат.',
            ],
            [
                'dress_id' => 22,
                'language' => 'en',
                'title' => 'Pink and red dress in the style of Marilyn Monroe for rent in Almaty',
                'description' => 'Long pink dress with long gloves. The dress is also available in red. Inspired by the image of Marilyn Monroe and her song "Girls best friends are diamonds." Rental period: day.',
            ],
            [
                'dress_id' => 22,
                'language' => 'ru',
                'title' => 'Розовое и красное платье в стиле Мэрилин Монро на прокат в Алматы',
                'description' => 'Длинное розовое платье с длинными перчатками. Платье также есть в красном цвете. Вдохновились образом Мерилин Монро и ее песней "Лучшие друзья девушек - это бриллианты". Срок проката: сутки.',
            ],
            [
                'dress_id' => 22,
                'language' => 'kk',
                'title' => 'Алматыда Мэрилин Монро стиліндегі қызғылт және қызыл көйлек жалға беріледі',
                'description' => 'Ұзын қолғапты ұзын қызғылт көйлек. Көйлек қызыл түсте де бар. Мэрилин Монро бейнесі мен оның «Қыздардың ең жақсы достары - гауһар тастар» әнінен шабыттанған. Жалдау мерзімі: 24 сағат.',
            ],

            [
                'dress_id' => 23,
                'language' => 'en',
                'title' => 'Muslim jumpsuit for rent in Almaty',
                'description' => 'Muslim overalls for rent in Almaty. The original costume consists of a jumpsuit, a cape over trousers and a scarf. Color - dark turquoise. Rental period: day.',
            ],
            [
                'dress_id' => 23,
                'language' => 'ru',
                'title' => 'Мусульманский комбинезон напрокат в Алматы',
                'description' => 'Мусульманский комбинезон напрокат в Алматы. Оригинальный костюм состоит из комбинезона, накидки поверх брюк и платка. Цвет - темно-бирюзовый. Срок проката: сутки.',
            ],
            [
                'dress_id' => 23,
                'language' => 'kk',
                'title' => 'Алматыда мұсылмандық комбинезон жалға беріледі',
                'description' => 'Алматыда мұсылмандық комбинезон жалға беріледі. Түпнұсқа костюм комбинезоннан, шалбардың үстіндегі шапан мен шарфтан тұрады. Түсі - қою көгілдір. Жалдау мерзімі: 24 сағат.',
            ],


            [
                'dress_id' => 24,
                'language' => 'en',
                'title' => 'Muslim dress with a fluffy skirt for rent in Almaty',
                'description' => 'Elegant Muslim dress with a fluffy skirt. There is a scarf included. Color - fashionable electro. There is also a dress for a girl with a height of 86-98. Rental period: day.',
            ],
            [
                'dress_id' => 24,
                'language' => 'ru',
                'title' => 'Мусульманское платье с пышной юбкой напрокат в Алматы',
                'description' => 'Нарядное мусульманское платье с пышной юбкой. В комплекте есть платок. Цвет - модный электро. Также есть платье для девочки на рост 86-98. Срок проката: сутки.',
            ],
            [
                'dress_id' => 24,
                'language' => 'kk',
                'title' => 'Алматыда үлпілдек юбкалы мұсылман көйлегі жалға беріледі',
                'description' => 'Үлпілдек юбкасымен талғампаз мұсылман көйлегі. Шарфы бар. Түсі - сәнді электро. Бойы 86-98 болатын қызға арналған көйлек де бар. Жалдау мерзімі: 24 сағат.',
            ],

            [
                'dress_id' => 25,
                'language' => 'en',
                'title' => 'Velvet engagement set for rent in Almaty',
                'description' => 'Camisole with long sleeves and saukele are made of natural silk velvet. Patterns are embroidered by hand from silk thread and natural stones. The dress is made of tulle, the fluffy skirt has a train. The set includes decorations. Rental period: day.',
            ],
            [
                'dress_id' => 25,
                'language' => 'ru',
                'title' => 'Бархатный комплект для узату напрокат в Алматы',
                'description' => 'Камзол с длинными рукавами и саукеле сшиты из натурального шелкового бархата. Узоры вышиты вручную из шелковой нити и натуральных камней. Платье сшито из фатина, пышная юбка имеет шлейф. В комплекте есть украшения. Срок проката: сутки.',
            ],
            [
                'dress_id' => 25,
                'language' => 'kk',
                'title' => 'Алматыда ұзартуға арналған барқыт жиынтық жалға беріледі',
                'description' => 'Ұзын жеңді камзол және сәукеле табиғи жібек барқыттан тігіледі. Үлгілер жібек жіптен және табиғи тастардан қолмен кестеленген. Көйлек тюльден тігілген, үлпілдек белдемшеде пойыз бар. Жиынтықта декорациялар бар. Жалдау мерзімі: 24 сағат.',
            ],


        ];

        DressTranslation::insert($dressesTranslations);
    }

    /**
     * @return void
     */
    public function updateCategories(): void
    {
        Category::where('category_id', 6)->update(['order' => 100, 'dress_id' => 16]);
        Category::where('category_id', 1)->update(['order' => 95, 'dress_id' => 2]);
        Category::where('category_id', 4)->update(['order' => 90, 'dress_id' => 6]);
        Category::where('category_id', 3)->update(['order' => 80, 'dress_id' => 32]);
        Category::where('category_id', 7)->update(['order' => 70, 'dress_id' => 22]);
        Category::where('category_id', 5)->delete();
        Category::where('category_id', 9)->update(['order' => 50, 'dress_id' => 29]);
        Category::where('category_id', 8)->update(['order' => 40, 'dress_id' => 23]);
        Category::where('category_id', 2)->update(['order' => 10, 'dress_id' => 4]);
    }


}
