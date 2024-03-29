<?php

namespace Database\Seeders;

use App\Helpers\V1\Helper;
use App\Models\V1\Booking;
use App\Models\V1\Category;
use App\Models\V1\CategoryTranslation;
use App\Models\V1\Color;
use App\Models\V1\ColorTranslation;
use App\Models\V1\ComponentTranslation;
use App\Models\V1\Dress;
use App\Models\V1\DressPrice;
use App\Models\V1\DressColor;
use App\Models\V1\DressSize;
use App\Models\V1\DressTranslation;
use App\Models\V1\Photo;
use App\Models\V1\Size;
use App\Models\V1\User\Permission;
use App\Models\V1\User\User;
use App\Models\V1\User\UserPermission;
use App\Models\V1\Component;
use App\Models\V1\BookingComponent;
use App\Models\V2\BookingColorSize;
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


        $this->generateLanguages();
        $this->generateCurrencies();

        $this->generatePermissions();
        $this->generateUser();
        $this->generateCategory();
        $this->generateComponent();
        $this->generateColor();
        $this->generateSize();
        $this->generateDress();
        $this->generateDressColor();
        $this->generateDressSize();
        $this->generatePhoto();
        $this->generateBooking();
        $this->generateBookingComponent();
        $this->generateBookingColorSize();
        $this->generateDressPrice();
    }

    public function generateDress()
    {
        $dresses = [
            [
                'user_id' => 2,
                'quantity' => 9,
                'components' => [1, 2],
                'categories' => [1],
            ],
            [
                'user_id' => 2,
                'quantity' => 0,
                'components' => [2],
                'categories' => [1],
            ],
            [
                'user_id' => 2,
                'quantity' => 1,
                'components' => [3],
                'categories' => [1],
            ],
            [
                'user_id' => 2,
                'quantity' => 7,
                'components' => [4, 5],
                'categories' => [1],
            ],
            [
                'user_id' => 2,
                'quantity' => 12,
                'components' => [1],
                'categories' => [1],
            ],
        ];

        $dressesPhoto = [];
        foreach ($dresses as $dress) {
            $photos = $dress['photos'] ?? [];
            $categories = $dress['categories'] ?? [];
            $components = $dress['components'] ?? [];
            unset($dress['photos']);
            unset($dress['categories']);
            unset($dress['components']);
            unset($dress['colors']);
            unset($dress['sizes']);

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
            $newDress->component()->attach($components);

            foreach ($photos as $photo)
                $dressesPhoto[] = [
                    'dress_id' => $newDress->dress_id,
                    'image' => $photo
                ];
        }

        if (count($dressesPhoto))
            Photo::insert($dressesPhoto);

        $this->generateDressTranslation();
    }

    public function generateDressColor()
    {
        $dressesColors = [
            [
                'dress_id' => 1,
                'color_id' => 1,
                'quantity' => 3,
            ],
            [
                'dress_id' => 1,
                'color_id' => 2,
                'quantity' => 1,
            ],
            [
                'dress_id' => 1,
                'color_id' => 4,
                'quantity' => 6,
            ],
            [
                'dress_id' => 2,
                'color_id' => 2,
                'quantity' => 3,
            ],
            [
                'dress_id' => 2,
                'color_id' => 3,
                'quantity' => 4,
            ],
            [
                'dress_id' => 3,
                'color_id' => 5,
                'quantity' => 1,
            ],
            [
                'dress_id' => 3,
                'color_id' => 2,
                'quantity' => 2,
            ],
            [
                'dress_id' => 4,
                'color_id' => 3,
                'quantity' => 2,
            ],
            [
                'dress_id' => 4,
                'color_id' => 1,
                'quantity' => 7,
            ],
            [
                'dress_id' => 5,
                'color_id' => 4,
                'quantity' => 1,
            ],
            [
                'dress_id' => 5,
                'color_id' => 5,
                'quantity' => 4,
            ],
        ];
        DressColor::insert($dressesColors);
    }

    public function generateDressSize()
    {
        $dressesSizes = [
            [
                'dress_id' => 1,
                'size_id' => 2,
                'quantity' => 4,
            ],
            [
                'dress_id' => 1,
                'size_id' => 4,
                'quantity' => 1,
            ],
            [
                'dress_id' => 1,
                'size_id' => 5,
                'quantity' => 2,
            ],
            [
                'dress_id' => 2,
                'size_id' => 2,
                'quantity' => 3,
            ],
            [
                'dress_id' => 2,
                'size_id' => 3,
                'quantity' => 4,
            ],
            [
                'dress_id' => 3,
                'size_id' => 5,
                'quantity' => 4,
            ],
            [
                'dress_id' => 3,
                'size_id' => 2,
                'quantity' => 5,
            ],
            [
                'dress_id' => 4,
                'size_id' => 2,
                'quantity' => 2,
            ],
            [
                'dress_id' => 4,
                'size_id' => 3,
                'quantity' => 7,
            ],
            [
                'dress_id' => 5,
                'size_id' => 1,
                'quantity' => 1,
            ],
            [
                'dress_id' => 5,
                'size_id' => 5,
                'quantity' => 4,
            ],
        ];
        DressSize::insert($dressesSizes);
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

    public function generateCategory()
    {
        $categories = [
            [], [], [], [], [], [], [], [], [],
        ];

        foreach ($categories as $category) {
            Category::create(
                [
                    ...$category,
                    ...[
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                ]
            );
        }

        $this->generateCategoryTranslation();
    }

    public function generateCategoryTranslation()
    {
        $categoriesTransactions = [
            [
                'category_id' => 1,
                'language' => 'ru',
                'title' => 'Вечерние платья',
                'description' => 'Аренда и прокат идеальных вечерних платьев для особого случая, мероприятия или фотосессии.',
            ],
            [
                'category_id' => 1,
                'language' => 'en',
                'title' => 'Evening dresses',
                'description' => 'Rent the perfect evening dresses for your special occasion, event or photo shoot.',
            ],
            [
                'category_id' => 1,
                'language' => 'kk',
                'title' => 'Кешкі көйлек',
                'description' => 'Ерекше жағдайға, оқиғаға немесе фотосессияға тамаша кешкі көйлектерді жалға алыңыз.',
            ],
            [
                'category_id' => 2,
                'language' => 'ru',
                'title' => 'Платья для фотосессии',
                'description' => 'Прокат платьев для фотосессий предлагает разнообразие моделей для вашего образа. Выбирайте из нашей коллекции и создайте неповторимые кадры без лишних затрат. Осуществите свои фотоидеи в стиле и элегантности!'
            ],
            [
                'category_id' => 2,
                'language' => 'en',
                'title' => 'Dresses for photo shoot',
                'description' => 'Rental of dresses for photo shoots offers a variety of models to suit your look. Choose from our collection and create unique shots at no extra cost. Realize your photo ideas in style and elegance!'
            ],
            [
                'category_id' => 2,
                'language' => 'kk',
                'title' => 'Фотосессияға арналған көйлектер',
                'description' => 'Фотосессияға арналған көйлектерді жалға беру сіздің келбетіңізге сәйкес келетін әртүрлі үлгілерді ұсынады. Біздің топтамамыздан таңдаңыз және қосымша ақысыз бірегей кадрлар жасаңыз. Фото идеяларыңызды стильде және талғампаздықта жүзеге асырыңыз!'
            ],
            [
                'category_id' => 3,
                'language' => 'ru',
                'title' => 'Свадебные платья',
                'description' => 'Аренда идеального свадебного платье ждет вас здесь! Широкий выбор в прокате свадебных платьев и нарядов поможет воплотить вашу мечту в реальность.'
            ],
            [
                'category_id' => 3,
                'language' => 'en',
                'title' => 'Wedding Dresses',
                'description' => 'Rent the perfect wedding dress awaits you here! A wide selection of wedding dresses and outfits for rent will help make your dream come true.'
            ],
            [
                'category_id' => 3,
                'language' => 'kk',
                'title' => 'Үйлену көйлегі',
                'description' => 'Мұнда сізді тамаша үйлену көйлегін жалға алыңыз! Үйлену көйлектері мен жалға берілетін киімдердің кең таңдауы сіздің арманыңызды жүзеге асыруға көмектеседі.'
            ],
            [
                'category_id' => 4,
                'language' => 'ru',
                'title' => 'Платья на узату',
                'description' => 'Аренда идеального платья для узату! Широкий выбор в прокате платьев для узату сделает этот особенный день самым счастливым.'
            ],
            [
                'category_id' => 4,
                'language' => 'en',
                'title' => 'Uzatu dresses',
                'description' => 'Rent the perfect Uzatu dress! A wide selection of Uzatu dresses for rent will make this special day the happiest.'
            ],
            [
                'category_id' => 4,
                'language' => 'kk',
                'title' => 'Ұзату көйлектер',
                'description' => 'Ұзату көйлегін жалға алыңыз! Ұзату көйлектерінің кең таңдауы осы ерекше күнді ең бақытты етеді.'
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
                'title' => 'Bridesmaid dresses',
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
                'description' => 'Окунитесь в культурное наследие! Казахские национальные этно-костюмы на прокат предлагают разнообразие стилей для особых событий. Откройте новые грани вашего образа в аутентичной одежде.'
            ],
            [
                'category_id' => 6,
                'language' => 'en',
                'title' => 'National ethno-costumes',
                'description' => 'Immerse yourself in cultural heritage! Kazakh national ethnic costumes for hire offer a variety of styles for special events. Discover new facets of your image in authentic clothes.'
            ],
            [
                'category_id' => 6,
                'language' => 'kk',
                'title' => 'Ұлттық этно-киімдер',
                'description' => 'Мәдени мұраға еніңіз! Жалдамалы қазақтың ұлттық этникалық киімдері ерекше іс-шараларға арналған әртүрлі стильдерді ұсынады. Нағыз киімде бейнеңіздің жаңа қырларын ашыңыз.'
            ],
            [
                'category_id' => 7,
                'language' => 'ru',
                'title' => 'Платья на выпускной',
                'description' => 'Прокат стильных платьев на выпускной предлагает модные варианты для вашего особого вечера. Почувствуйте себя уверенно и элегантно, не переплачивая за образ.'
            ],
            [
                'category_id' => 7,
                'language' => 'en',
                'title' => 'Dresses for graduating date',
                'description' => 'Stylish prom dress rentals offer fashionable options for your special evening. Feel confident and elegant without overpaying for the look.'
            ],
            [
                'category_id' => 7,
                'language' => 'kk',
                'title' => 'Выпускнойға көйлектер',
                'description' => 'Сәнді бітіру кеші көйлектерін жалға беру арнайы кешке арналған сәнді нұсқаларды ұсынады. Сыртқы көрініс үшін артық төлем жасамай, өзіңізді сенімді және талғампаз сезініңіз.'
            ],
            [
                'category_id' => 8,
                'language' => 'ru',
                'title' => 'Мусульманские платья и кейпы',
                'description' => 'Прокат мусульманских платьев и кейпов предлагает изысканные варианты для вашего состояния души.'
            ],
            [
                'category_id' => 8,
                'language' => 'en',
                'title' => 'Muslim dresses and capes',
                'description' => 'Renting Muslim dresses and capes offers exquisite options for your state of mind.'
            ],
            [
                'category_id' => 8,
                'language' => 'kk',
                'title' => 'Мұсылмандық көйлектер мен кейптер',
                'description' => 'Мұсылман көйлектері мен кейптер жалға алу сіздің көңіл-күйіңіз үшін керемет нұсқаларды ұсынады.'
            ],
            [
                'category_id' => 9,
                'language' => 'ru',
                'title' => 'Детские платья',
                'description' => 'Воплотите мечты вашей маленькой принцессы или принца в жизнь! Прокат детских платьев предлагает множество вариантов для парздничных мероприятий. Найдите идеальное платье, чтобы ваша девочка почувствовала себя настоящей звездой.'
            ],
            [
                'category_id' => 9,
                'language' => 'en',
                'title' => 'Children`s dress',
                'description' => 'Make your little princess or prince`s dreams come true! Renting children`s dresses offers many options for special occasions. Find the perfect dress to make your little girl feel like a real star.',
            ],
            [
                'category_id' => 9,
                'language' => 'kk',
                'title' => 'Балалар көйлегі',
                'description' => 'Кішкентай ханшайымыңыздың немесе ханзадаңыздың армандарын орындаңыз! Балалар көйлектерін жалға алу ерекше жағдайларда көптеген нұсқаларды ұсынады. Кішкентай қызыңызды нағыз жұлдыздай сезіну үшін тамаша көйлек табыңыз.'
            ],
        ];

        CategoryTranslation::insert($categoriesTransactions);
    }

    public function generateUser()
    {
        $users = [
            [
                'firstname' => 'Admin',
                'email' => 'admin@gatsby.kz',
                'phone' => '77772082140',
            ],
            [
                'firstname' => 'user',
                'email' => 'user@gatsby.kz',
                'phone' => '77026067276',
            ],
        ];

        $userData = [
            'updated_at' => now(),
            'created_at' => now(),
            'email_verified_at' => now()
        ];

        foreach ($users as $user) {
            $password = Helper::getRandomString(20);
            $user['password'] = bcrypt($password);
            $resultUsers [] = array_merge($user, $userData);
            echo sprintf('Add User %s (email: %s, password: %s)', $user['firstname'], $user['email'], $password) . "\n";
        }

        User::insert($resultUsers);

        $user = User::where('email', 'admin@gatsby.kz')->first();
        $permission = Permission::where('permission', 'ADMIN')->first();
        $user->permissions()->attach($permission);

        $user = User::where('email', 'user@gatsby.kz')->first();
        $permission = Permission::where('permission', 'SHOP_OWNER')->first();
        $user->permissions()->attach($permission);

    }

    public function generatePermissions()
    {
        $permissions = [
            'ADMIN',
            'SHOP_OWNER',
            'CLIENT',
        ];
        $permissionsCreate = [];
        foreach ($permissions as $permission) {
            $permissionsCreate[] = [
                'permission' => $permission,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        Permission::insert($permissionsCreate);
    }

    public function generateColor()
    {
        $colors = [
            ['color' => 'blue'],
            ['color' => 'black'],
            ['color' => 'red'],
            ['color' => 'purple'],
            ['color' => 'white'],
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
                'title' => 'Blue',
            ],
            [
                'color_id' => 1,
                'language' => 'ru',
                'title' => 'Голубой',
            ],
            [
                'color_id' => 1,
                'language' => 'kk',
                'title' => 'Көк',
            ],
            [
                'color_id' => 2,
                'language' => 'en',
                'title' => 'Black',
            ],
            [
                'color_id' => 2,
                'language' => 'ru',
                'title' => 'Черный',
            ],
            [
                'color_id' => 2,
                'language' => 'kk',
                'title' => 'Қара',
            ],
            [
                'color_id' => 3,
                'language' => 'en',
                'title' => 'Red',
            ],
            [
                'color_id' => 3,
                'language' => 'ru',
                'title' => 'Красный',
            ],
            [
                'color_id' => 3,
                'language' => 'kk',
                'title' => 'Қызыл',
            ],
            [
                'color_id' => 4,
                'language' => 'en',
                'title' => 'Purple',
            ],
            [
                'color_id' => 4,
                'language' => 'ru',
                'title' => 'Фиолетовый',
            ],
            [
                'color_id' => 4,
                'language' => 'kk',
                'title' => 'Kүлгін',
            ],
            [
                'color_id' => 5,
                'language' => 'en',
                'title' => 'White',
            ],
            [
                'color_id' => 5,
                'language' => 'ru',
                'title' => 'Белый',
            ],
            [
                'color_id' => 5,
                'language' => 'kk',
                'title' => 'Ақ',
            ],
        ];
        ColorTranslation::insert($colorsTranslations);
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

    public function generatePhoto()
    {
        $photos = [
            [
                'dress_id' => 1,
                'image' => 'evening/4-4.jpg',
                'image_small' => 'evening/4-4.jpg'
            ],
            [
                'dress_id' => 2,
                'image' => 'evening/4-4.jpg',
                'image_small' => 'evening/4-4.jpg'
            ],
            [
                'dress_id' => 3,
                'image' => 'evening/4-4.jpg',
                'image_small' => 'evening/4-4.jpg'
            ],
            [
                'dress_id' => 4,
                'image' => 'evening/4-4.jpg',
                'image_small' => 'evening/4-4.jpg'
            ],
            [
                'dress_id' => 5,
                'image' => 'evening/4-4.jpg',
                'image_small' => 'evening/4-4.jpg'
            ],

        ];

        Photo::insert($photos);
    }

    public function generateBooking()
    {
        $bookings = [
            [
                'dress_id' => 1,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'status' => Booking::STATUSES['NEW'],
                'email' => 'anastasya@test.com',
                'phone_number' => +77052332233,
                'quantity' => 1,
            ],
            [
                'dress_id' => 1,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'status' => Booking::STATUSES['APPROVED'],
                'email' => 'anelya@test.com',
                'phone_number' => +77052332222,
                'quantity' => 1,
            ],
            [
                'dress_id' => 3,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'status' => Booking::STATUSES['NEW'],
                'email' => 'karligash@test.com',
                'phone_number' => +77052332255,
                'quantity' => 1,
            ],
            [
                'dress_id' => 4,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'status' => Booking::STATUSES['NEW'],
                'email' => 'cvetlana@test.com',
                'phone_number' => +77052332244,
                'quantity' => 0,
            ],
            [
                'dress_id' => 5,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'status' => Booking::STATUSES['NEW'],
                'email' => 'alena@test.com',
                'phone_number' => +77052332277,
                'quantity' => 1,
            ],
            [
                'dress_id' => 5,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
                'status' => Booking::STATUSES['NEW'],
                'email' => 'margarita@test.com',
                'phone_number' => +77052332288,
                'quantity' => 3,
            ],
        ];
        Booking::insert($bookings);
    }

    public function generateBookingColorSize()
    {
        $bokingsColorsSizes = [
            [
                'booking_id' => 1,
                'color_id' => 1,
                'size_id' => 2,
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
            ],
            [
                'booking_id' => 1,
                'color_id' => 2,
                'size_id' => 4,
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
            ],
            [
                'booking_id' => 3,
                'color_id' => 5,
                'size_id' => 5,
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
            ],
            [
                'booking_id' => 5,
                'color_id' => 4,
                'size_id' => 1,
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
            ],
            [
                'booking_id' => 5,
                'color_id' => 5,
                'size_id' => 5,
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
            ],
        ];
        BookingColorSize::insert($bokingsColorsSizes);
    }

    public function generateComponent()
    {
        $components = [
            [
                'quantity' => 5,
                'price' => 3000,
            ],
            [
                'quantity' => 10,
                'price' => 4000,
            ],
            [
                'quantity' => 8,
                'price' => 2000,
            ],
            [
                'quantity' => 8,
                'price' => 7000,
            ],
            [
                'quantity' => 7,
                'price' => 7000,
            ],
        ];
        Component::insert($components);
        $this->generateComponentTranslation();
    }

    public function generateBookingComponent()
    {
        $bookingsComponents = [
            [
                'booking_id' => 1,
                'component_id' => 2,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
            ],
            [
                'booking_id' => 2,
                'component_id' => 1,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
            ],
            [
                'booking_id' => 4,
                'component_id' => 3,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
            ],
            [
                'booking_id' => 3,
                'component_id' => 4,
                'date' => date('Y-m-d'),
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d', strtotime('+2 days')),
            ],
        ];
        BookingComponent::insert($bookingsComponents);
    }

    public function generateComponentTranslation()
    {
        $componentsTranslations = [
            [
                'component_id' => 1,
                'language' => 'en',
                'title' => 'Short camisole',
                'description' => "Short camisoles with handmade author's embroidery. The design and patterns of each camisole are developed by fashion designer Aliya Musayeva from ApoltiStore, Saukele&Kamzol. Size: 42-44. Colors: purple, turquoise, black, pink.",
            ],
            [
                'component_id' => 1,
                'language' => 'ru',
                'title' => 'Короткий камзол',
                'description' => 'Короткие камзолы с ручной авторской вышивкой. Дизайн и узоры каждого камзола разрабатываются модельером Алией Мусаевой из ApoltiStore, Saukele&Kamzol. Размер: 42-44. Цвета: фиолетовый, бирюзовый, черный, розовый.',
            ],
            [
                'component_id' => 1,
                'language' => 'kk',
                'title' => 'Қысқа камзол',
                'description' => 'Қолмен тігілген авторлық кестелі қысқа камзолдар. Әр камзолдың дизайны мен өрнектерін ApoltiStore, Saukele&Kamzol дүкендерінің сәнгері Әлия Мұсаева әзірлеген. Өлшемі: 42-44. Түстер: күлгін, көгілдір, қара, қызғылт.',
            ],
            [
                'component_id' => 2,
                'language' => 'en',
                'title' => 'Veil and uki feathers',
                'description' => 'Veil and uki for the bride',
            ],
            [
                'component_id' => 2,
                'language' => 'ru',
                'title' => 'Фата и перья уки',
                'description' => 'Фата и перья уки для невесты',
            ],
            [
                'component_id' => 2,
                'language' => 'kk',
                'title' => 'Фата және уки қауырсындары',
                'description' => 'Келінге арналған орамал мен уки',
            ],
            [
                'component_id' => 3,
                'language' => 'en',
                'title' => 'Saukele on uzatu',
                'description' => 'Our craftsmen make light and beautiful saukeles. The design and patterns of each saukele are developed by fashion designer Aliya Musaeva from ApoltiStore',
            ],
            [
                'component_id' => 3,
                'language' => 'ru',
                'title' => 'Саукеле на узату',
                'description' => 'Наши мастера делают легкие и красивые саукеле. Дизайн и узоры каждого саукеле разрабатываются модельером Алией Мусаевой из ApoltiStore',
            ],
            [
                'component_id' => 3,
                'language' => 'kk',
                'title' => 'Сәукеле ұзату',
                'description' => 'Біздің шеберлер жеңіл әрі әдемі сәукеле жасайды. Әр сәукеленің дизайны мен өрнектерін ApoltiStore дүкенінен сәнгер Әлия Мұсаева әзірлеген',
            ],
            [
                'component_id' => 4,
                'language' => 'en',
                'title' => 'National ornaments for uzat',
                'description' => 'We have sets of national decorations that you can rent. There are earrings, besbilezik, bracelets and a necklace (alqa)',
            ],
            [
                'component_id' => 4,
                'language' => 'ru',
                'title' => 'Национальные украшения на узату',
                'description' => 'У нас есть комплекты национальных украшений, которые можно взять напрокат. Есть серьги, бесбилезик, браслеты и ожерелье (алқа)',
            ],
            [
                'component_id' => 4,
                'language' => 'kk',
                'title' => 'Ұзатуға арналған ұлттық ою-өрнектер',
                'description' => 'Бізде ұлттық әшекейлер жиынтығы бар, оларды жалға алуға болады. Сырға, бесбілезік, білезік және алқа (алқа) бар.',
            ],
            [
                'component_id' => 5,
                'language' => 'en',
                'title' => 'Handkerchief',
                'description' => "Handkerchief with handmade author's embroidery. The design and patterns of each camisole are developed by fashion designer Aliya Musayeva from ApoltiStore, Saukele&Kamzol. Size: 42-44. Colors: purple, turquoise, black, pink.",
            ],
            [
                'component_id' => 5,
                'language' => 'ru',
                'title' => 'Платок',
                'description' => 'Платок с ручной авторской вышивкой. Дизайн и узоры каждого камзола разрабатываются модельером Алией Мусаевой из ApoltiStore, Saukele&Kamzol. Размер: 42-44. Цвета: фиолетовый, бирюзовый, черный, розовый.',
            ],
            [
                'component_id' => 5,
                'language' => 'kk',
                'title' => 'Орамал',
                'description' => 'Орамал авторлық кестелі қысқа камзолдар. Әр камзолдың дизайны мен өрнектерін ApoltiStore, Saukele&Kamzol дүкендерінің сәнгері Әлия Мұсаева әзірлеген. Өлшемі: 42-44. Түстер: күлгін, көгілдір, қара, қызғылт.',
            ],
        ];
        ComponentTranslation::insert($componentsTranslations);
    }

    public function generateDressPrice()
    {
        $dressesPrices = [
            [
                'dress_id' => 1,
                'code' => 'KZT',
                'price' => 3000,
            ],
            [
                'dress_id' => 1,
                'code' => 'RUB',
                'price' => 517.55,
            ],
            [
                'dress_id' => 1,
                'code' => 'USD',
                'price' => 6.74,
            ],
            [
                'dress_id' => 2,
                'code' => 'KZT',
                'price' => 7000,
            ],
            [
                'dress_id' => 2,
                'code' => 'RUB',
                'price' => 1207.63,
            ],
            [
                'dress_id' => 2,
                'code' => 'USD',
                'price' => 15.72,
            ],
            [
                'dress_id' => 3,
                'code' => 'KZT',
                'price' => 12000,
            ],
            [
                'dress_id' => 3,
                'code' => 'RUB',
                'price' => 2070.22,
            ],
            [
                'dress_id' => 3,
                'code' => 'USD',
                'price' => 26.95,
            ],
            [
                'dress_id' => 4,
                'code' => 'KZT',
                'price' => 9800,
            ],
            [
                'dress_id' => 4,
                'code' => 'RUB',
                'price' => 1690.68,
            ],
            [
                'dress_id' => 4,
                'code' => 'USD',
                'price' => 22.01,
            ],
            [
                'dress_id' => 5,
                'code' => 'KZT',
                'price' => 15000,
            ],
            [
                'dress_id' => 5,
                'code' => 'RUB',
                'price' => 2587.77,
            ],
            [
                'dress_id' => 5,
                'code' => 'USD',
                'price' => 33.69,
            ],
        ];
        DressPrice::insert($dressesPrices);
    }

    public function generateCurrencies()
    {
        (new CurrencySeeder())->run();
    }

    public function generateLanguages()
    {
        (new LanguageSeeder())->run();
    }
}
