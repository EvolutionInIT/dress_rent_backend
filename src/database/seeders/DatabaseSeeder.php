<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Color;
use App\Models\ColorTranslation;
use App\Models\Dress;
use App\Models\DressCategory;
use App\Models\DressColor;
use App\Models\DressSize;
use App\Models\DressTranslation;
use App\Models\Photo;
use App\Models\Size;
use App\Models\V1\User;
use App\Helpers\V1\Helper;
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
        $ls = new LanguageSeeder();
        $ls->generateLanguages();
        $this->generateUser();
        $this->generateCategory();
        $this->generateDress();
        //$this->generateDressCategory();
        $this->generateColor();
        $this->generateDressColor();
        $this->generateSize();
        $this->generateDressSize();
        //$this->generatePhoto();
        //$this->generateBooking();
        $this->generateCategoryTranslation();
        $this->generateDressTranslation();
        $this->generateColorTranslation();
    }

    public function generateDress()
    {
        $dresses = [
            [
                'user_id' => 2,
                'quantity' => 3,
            ],
            [
                'user_id' => 2,
                'quantity' => 0,
            ],
            [
                'user_id' => 2,
                'quantity' => 1,
            ],
            [
                'user_id' => 2,
                'quantity' => 7,
            ],
            [
                'user_id' => 2,
                'quantity' => 12,
            ],
        ];

        $dressesPhoto = [];
        foreach ($dresses as $dress) {
            $photos = $dress['photos'] ?? [];
            $categories = $dress['categories'] ?? [];
            unset($dress['photos']);
            unset($dress['categories']);

            $newDress = Dress::create(
                [
                    ...$dress,
                    ...[
                        'updated_at' => now(),
                        'created_at' => now(),
                    ],
                ]
            );

            $newDress->category()->attach($categories);

            foreach ($photos as $photo)
                $dressesPhoto[] = [
                    'dress_id' => $newDress->dress_id,
                    'image' => $photo
                ];


        }

        if (count($dressesPhoto))
            Photo::insert($dressesPhoto);


//        $dressData = [
//            'updated_at' => now(),
//            'created_at' => now()
//        ];
//
//
//        foreach ($dresses as $dress)
//            $resultDresses [] = array_merge($dress, $dressData);
//
//        Dress::insert($resultDresses);


    }

    public function generateCategory()
    {
        $categories = [
            ['category_id' => 1],
            ['category_id' => 2],
            ['category_id' => 3],
            ['category_id' => 4],
            ['category_id' => 5],
            ['category_id' => 6],
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
        $dressesCategories = [
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
        DressCategory::insert($dressesCategories);
    }

    public function generateUser()
    {
        $users = [
            [
                'firstname' => 'Admin',
                'email' => 'admin@admin.com',
            ],
            [
                'firstname' => 'user',
                'email' => 'user@admin.com',
            ],
        ];

        $userData = [
            'updated_at' => now(),
            'created_at' => now(),
            'email_verified_at' => now()
        ];

        foreach ($users as $user) {
            $password = Helper::getRandomString(20);
            $user['password'] =  bcrypt($password);
            $resultUsers [] = array_merge($user, $userData);
            echo sprintf('Add User %s (email: %s, password: %s)', $user['firstname'], $user['email'], $password) . "\n";
        }

        User::insert($resultUsers);
    }

    public function generateColor()
    {
        $colors = [
            [], [], [], [], [],
        ];
        Color::insert($colors);
    }

    public function generateDressColor()
    {
        $dressesColors = [
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
        DressColor::insert($dressesColors);
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
        $dressesSizes = [
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
        DressSize::insert($dressesSizes);
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
        $bookings = [
            [
                'dress_id' => 1,
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
            [
                'dress_id' => 1,
                'date' => '2023-02-22',
                'status' => Booking::STATUSES['APPROVED'],
            ],
            [
                'dress_id' => 1,
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
            [
                'dress_id' => 1,
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
            [
                'dress_id' => 1,
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
            [
                'dress_id' => 1,
                'date' => today(),
                'status' => Booking::STATUSES['NEW'],
            ],
        ];
        Booking::insert($bookings);
    }

    public function generateCategoryTranslation()
    {
        $categoriesTransactions = [
            [
                'category_id' => 1,
                'language' => 'ru',
                'title' => 'Вечерние платья',
                'description' => 'Аренда вечерних платьев для фотосессией. Аренда платьев на фотосессии, в том числе и вечерних, является одним из самых популярных видов услуг. Фотографы часто ищут для своих съемок не только одежду в прокате, но и людей с соответствующим образом, поэтому аренда платьев часто нужна. В нашей студии вы можете арендовать вечерние платья на любую тематику и для любого мероприятия. При необходимости можно даже заказать пошив вечернего платья по вашему индивидуальному эскизу.',
            ],
            [
                'category_id' => 1,
                'language' => 'en',
                'title' => 'Evening dresses',
                'description' => 'Rent of evening dresses for a photo session. Renting dresses for photo shoots, including evening ones, is one of the most popular types of services. Photographers often look for not only rental clothes for their shoots, but also people with the appropriate look, so renting dresses is often needed. In our studio you can rent evening dresses for any theme and for any event. If necessary, you can even order tailoring of an evening dress according to your individual sketch.',
            ],
            [
                'category_id' => 1,
                'language' => 'kk',
                'title' => 'Кешкі көйлек',
                'description' => 'Фотосессияға кешкі көйлектерді жалға алу. Фотосессияларға, соның ішінде кешкі көйлектерді жалға алу - ең танымал қызмет түрлерінің бірі. Фотографтар көбінесе өз түсірілімдері үшін жалдамалы киімдерді ғана емес, сонымен қатар сәйкес келбеті бар адамдарды да іздейді, сондықтан көйлектерді жалға алу жиі қажет. Біздің студияда сіз кез келген тақырыпқа және кез келген іс-шараға арналған кешкі көйлектерді жалға ала аласыз. Қажет болса, сіз өзіңіздің жеке эскизіңізге сәйкес кешкі көйлекті тігуге тапсырыс бере аласыз.',
            ],
            [
                'category_id' => 2,
                'language' => 'ru',
                'title' => 'Платья для фотосессий',
                'description' => 'Шикарные и стильные платья, аксессуары и обувь в аренду для фотосессий.'
            ],
            [
                'category_id' => 2,
                'language' => 'en',
                'title' => 'Dresses for photo shoots',
                'description' => 'Chic and stylish dresses, accessories and shoes for rent for photo shoots.'
            ],
            [
                'category_id' => 2,
                'language' => 'kk',
                'title' => 'Фотосессияға арналған көйлектер',
                'description' => 'Сәнді және сәнді көйлектер, аксессуарлар және фотосессиялар үшін жалға берілетін аяқ киім.'
            ],
            [
                'category_id' => 3,
                'language' => 'ru',
                'title' => 'Свадебные платья',
                'description' => 'Свадебные платья простые, но со вкусом'
            ],
            [
                'category_id' => 3,
                'language' => 'en',
                'title' => 'Wedding Dresses',
                'description' => 'Wedding dresses are simple but tasteful'
            ],
            [
                'category_id' => 3,
                'language' => 'kk',
                'title' => 'Үйлену көйлегі',
                'description' => 'Үйлену көйлектері қарапайым, бірақ талғампаз'
            ],
            [
                'category_id' => 4,
                'language' => 'ru',
                'title' => 'Платья на узату',
                'description' => 'Платья на узату'
            ],
            [
                'category_id' => 4,
                'language' => 'en',
                'title' => 'Dresses with knots',
                'description' => 'Dresses with knots'
            ],
            [
                'category_id' => 4,
                'language' => 'kk',
                'title' => 'Түйіндері бар көйлектер',
                'description' => 'Түйіндері бар көйлектер'
            ],
            [
                'category_id' => 5,
                'language' => 'ru',
                'title' => 'Платья для подружки невесты',
                'description' => 'Разные виды платьев для невесты'
            ],
            [
                'category_id' => 5,
                'language' => 'en',
                'title' => 'Bridesmaid Dresses',
                'description' => 'Different types of dresses for the bride'
            ],
            [
                'category_id' => 5,
                'language' => 'kk',
                'title' => 'Қалыңдық көйлектері',
                'description' => 'Қалыңдыққа арналған көйлектердің әртүрлі түрлері'
            ],
            [
                'category_id' => 6,
                'language' => 'ru',
                'title' => 'Национальные этно-костюмы',
                'description' => 'Разные виды национальных этно-костюмов'
            ],
            [
                'category_id' => 6,
                'language' => 'en',
                'title' => 'National ethnic costumes',
                'description' => 'Different types of national ethnic costumes'
            ],
            [
                'category_id' => 6,
                'language' => 'kk',
                'title' => 'Ұлттық этникалық киімдер',
                'description' => 'Ұлттық этникалық киімдердің әртүрлі түрлері'
            ],
        ];

        CategoryTranslation::insert($categoriesTransactions);
    }

    public function generateDressTranslation()
    {
        $dressesTranslations = [
            [
                'dress_id' => 1,
                'title' => 'Вечернее платье Allison',
                'description' => 'Вечернее платье длиной в пол из пайеточной ткани чёрного цвета. Топ без рукавов с вырезом в виде капли. Закрытая спина на молнии. Юбка длиной в пол, без шлейфа',
                'language' => 'ru'
            ],
            [
                'dress_id' => 1,
                'title' => 'Allison evening dress',
                'description' => 'Floor-length evening dress in black sequin fabric. Sleeveless top with teardrop neckline. Closed back with zipper. Floor-length skirt, no train',
                'language' => 'en'
            ],
            [
                'dress_id' => 1,
                'title' => 'Allison кешкі көйлегі',
                'description' => 'Қара блестки матадан тігілген еденге арналған кешкі көйлек. Жеңі жоқ үстіңгі белдемше. Артқы жағы найзағаймен жабылған. Еденге жететін юбка, пойыз жоқ',
                'language' => 'kk'
            ],
            [
                'dress_id' => 2,
                'title' => 'Вечернее платье плиссе Penelope Powder Pink',
                'description' => 'Длинное вечернее платье пепельно-розового цвета. Выполнено из плиссированной ткани. Топ в стиле американская пройма с вырезом на груди и открытыми плечами.Спинка полностью закрыта. На юбке небольшой разрез под левую ножку.',
                'language' => 'ru',
            ],
            [
                'dress_id' => 2,
                'title' => 'Pleated evening dress Penelope Powder Pink',
                'description' => 'Long evening dress in ash-pink color. Made from pleated fabric. American armhole style top with a cutout at the bust and bare shoulders.The back is completely closed. The skirt has a small slit for the left leg.',
                'language' => 'en',
            ],
            [
                'dress_id' => 2,
                'title' => 'Бүктелген кешкі көйлек Penelope Powder Pink',
                'description' => 'Күлді қызғылт түсті кешкі ұзын көйлек. Бүктелген матадан жасалған. Кеуде және жалаң иықтары бар американдық қолтық стиліндегі топ.Артқы жағы толығымен жабылған. Юбканың сол аяққа арналған кішкене тесігі бар.',
                'language' => 'kk',
            ],
            [
                'dress_id' => 3,
                'title' => 'Шуба Круэллы Cruella Coat',
                'description' => 'Шубка-макси из искусственного меха чёрно-белой расцветки под далматинца. Массивный воротник. Приталенная. Застёгивается на пуговицу.',
                'language' => 'ru',
            ],
            [
                'dress_id' => 3,
                'title' => 'Cruella Coat',
                'description' => 'Black and white Dalmatian faux fur maxi coat. Massive collar. Fitted. Fastens with a button.',
                'language' => 'en',
            ],
            [
                'dress_id' => 3,
                'title' => 'Cruella тон Cruella Coat',
                'description' => 'Қара және ақ далматиялық жасанды үлбір макси пальто. Жаппай жаға. Орнатылған. Түймемен бекітіледі.',
                'language' => 'kk',
            ],
            [
                'dress_id' => 4,
                'title' => 'Fashion Hunter',
                'description' => 'Эффектное белое платье с длинными рукавами, декорированными перьями. Глубокий V-образный вырез декольте.На груди и бедре нашита прозрачная сетка со стразами. Талию украшает пояс. Длинная юбка с небольшим шлейфом и высоким разрезом по ножке.Спина закрыта, застегивается на молнию.',
                'language' => 'ru',
            ],
            [
                'dress_id' => 4,
                'title' => 'Fashion Hunter',
                'description' => 'Spectacular white dress with long sleeves decorated with feathers. Deep V neckline.A transparent mesh with rhinestones is sewn on the chest and thigh. The waist is decorated with a belt. Long skirt with a small train and a high leg slit.The back is closed, fastened with a zipper.',
                'language' => 'en',
            ],
            [
                'dress_id' => 4,
                'title' => 'Fashion Hunter',
                'description' => 'Қауырсынмен безендірілген ұзын жеңі бар керемет ақ көйлек. Терең V мойын сызығы.Кеуде мен жамбасқа ринстондар бар мөлдір тор тігіледі. Белі белдікпен безендірілген. Ұзын юбка шағын пойыз және жоғары аяғы тесігі бар.Артқы жағы жабық, найзағаймен бекітілген.',
                'language' => 'kk',
            ],
            [
                'dress_id' => 5,
                'title' => 'Накидка из перьев со шлейфом Feather Cape Discount',
                'description' => 'Накидка из белых гусиных перьев. Спина и плечи декорированы кристаллами.Длина от верха до конца шлейфа: 3 м. 15 см. Не застегивается.',
                'language' => 'ru',
            ],
            [
                'dress_id' => 5,
                'title' => 'Feather Cape Discount',
                'description' => 'Cape of white goose feathers. The back and shoulders are decorated with crystals.Length from the top to the end of the train: 3 m. 15 cm. Does not fasten.',
                'language' => 'en',
            ],
            [
                'dress_id' => 5,
                'title' => 'Feather Cape жеңілдік',
                'description' => 'Ақ қаз қауырсынының мүйісі. Арқасы мен иығы кристалдармен безендірілген.Пойыздың басынан аяғына дейінгі ұзындығы: 3м.15см.Бекімейді.',
                'language' => 'kk',
            ],
        ];

        DressTranslation::insert($dressesTranslations);
    }

    public function generateColorTranslation()
    {
        $colorsTranslations = [
            [
                'color_id' => 1,
                'language' => 'en',
                'color' => 'Blue',
            ],
            [
                'color_id' => 1,
                'language' => 'ru',
                'color' => 'Голубой',
            ],
            [
                'color_id' => 1,
                'language' => 'kk',
                'color' => 'Көк',
            ],
            [
                'color_id' => 2,
                'language' => 'en',
                'color' => 'Black',
            ],
            [
                'color_id' => 2,
                'language' => 'ru',
                'color' => 'Черный',
            ],
            [
                'color_id' => 2,
                'language' => 'kk',
                'color' => 'Қара',
            ],
            [
                'color_id' => 3,
                'language' => 'en',
                'color' => 'Red',
            ],
            [
                'color_id' => 3,
                'language' => 'ru',
                'color' => 'Красный',
            ],
            [
                'color_id' => 3,
                'language' => 'kk',
                'color' => 'Қызыл',
            ],
            [
                'color_id' => 4,
                'language' => 'en',
                'color' => 'Purple',
            ],
            [
                'color_id' => 4,
                'language' => 'ru',
                'color' => 'Фиолетовый',
            ],
            [
                'color_id' => 4,
                'language' => 'kk',
                'color' => 'Kүлгін',
            ],
            [
                'color_id' => 5,
                'language' => 'en',
                'color' => 'White',
            ],
            [
                'color_id' => 5,
                'language' => 'ru',
                'color' => 'Белый',
            ],
            [
                'color_id' => 5,
                'language' => 'kk',
                'color' => 'Ақ',
            ],
        ];
        ColorTranslation::insert($colorsTranslations);
    }

}
