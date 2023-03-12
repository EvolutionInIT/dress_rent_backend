<?php

namespace Database\Seeders;

use App\Models\Dress;
use App\Models\Photo;
use Illuminate\Database\Seeder;
use App\Models\DressTranslation;

class ApoltiSeeder extends Seeder
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
        $ds = new DatabaseSeeder();
        $ds->generateCategory();
        $ds->generatePermissions();
        $ds->generateUser();
        $ds->generateColor();
        $ds->generateSize();

        $this->generateDress();
        $this->generateDressTranslation();
    }

    public function generateDress()
    {
        $dresses = [
            [
                'user_id' => 1,
                'photos' => ['evening/4-2.jpg', 'evening/4-1.jpg', 'evening/4-3.jpg', 'evening/4-4.jpg'],
                'categories' => [1],
                'price' => 10000,
            ],
            [
                'user_id' => 1,
                'photos' => ['evening/16-2.jpg', 'evening/16-1.jpg', 'evening/16-3.jpg'],
                'categories' => [1],
                'price' => 15000,
            ],
            [
                'user_id' => 1,
                'photos' => ['evening/5-1.jpg', 'evening/5-2.jpg', 'evening/5-3.jpg', 'evening/5-4.jpg', 'evening/5-5.jpg',],
                'categories' => [1],
                'price' => 15000,
            ],
            [
                'user_id' => 1,
                'photos' => ['photosession/1-1.jpg', 'photosession/1-2.jpg', 'photosession/1-2.jpg', 'photosession/1-4.jpg', 'photosession/1-5.jpg'],
                'categories' => [1],
                'price' => 30000,
            ],
            [
                'user_id' => 1,
                'photos' => ['photosession/6-1.jpg', 'photosession/6-2.jpg', 'photosession/6-3.jpeg', 'photosession/6-4.jpg', 'photosession/6-5.jpg'],
                'categories' => [2],
                'price' => 35000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/2-1.jpg', 'uzatu/2-2.jpg', 'uzatu/2-3.jpg', 'uzatu/2-4.jpg', 'uzatu/2-5.jpg'],
                'categories' => [4],
                'price' => 80000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/3-1.jpg', 'uzatu/3-2.jpg', 'uzatu/3-3.jpg', 'uzatu/3-4.jpg'],
                'categories' => [4],
                'price' => 80000,
            ],
            [
                'user_id' => 1,
                'photos' => ['uzatu/8-4.jpg', 'uzatu/8-1.jpg', 'uzatu/8-2.jpg', 'uzatu/8-3.jpg', 'uzatu/8-5.jpg'],
                'categories' => [4],
                'price' => 80000,
            ],
            [
                'user_id' => 1,
                'price' => 50000,
                'photos' => ['uzatu/11-1.jpg', 'uzatu/11-2.jpg', 'uzatu/11-3.jpg'],
                'categories' => [4],
            ],
            [
                'user_id' => 1,
                'price' => 50000,
                'photos' => ['uzatu/12-1.jpg', 'uzatu/12-2.jpg', 'uzatu/12-3.jpg'],
                'categories' => [4],
            ],
            [
                'user_id' => 1,
                'price' => 10000,
                'photos' => ['uzatu/13-3.jpg', 'uzatu/13-2.jpg', 'uzatu/13-1.jpg'],
                'categories' => [4, 6],
            ],
            [
                'user_id' => 1,
                'price' => 4000,
                'photos' => ['uzatu/20-2.jpg', 'uzatu/19-2.jpg', 'uzatu/19-1.jpg', 'uzatu/19-3.jpg', 'uzatu/20-1.jpg', 'uzatu/20-3.jpg',],
                'categories' => [4],
            ],
            [
                'user_id' => 1,
                'price' => 10000,
                'photos' => ['uzatu/12-3.jpg', 'uzatu/3-4.jpg', 'uzatu/11-1.jpg',],
                'categories' => [4],
            ],
            [
                'user_id' => 1,
                'price' => 3000,
                'photos' => ['uzatu/21-2.jpg', 'uzatu/21-1.jpg'],
                'categories' => [4, 6],
            ],
            [
                'user_id' => 1,
                'price' => 15000,
                'photos' => ['national/kazakh/17-1.jpg', 'national/kazakh/17-2.jpg', 'national/kazakh/17-3.jpg'],
                'categories' => [6],
            ],
            [
                'user_id' => 1,
                'price' => 15000,
                'photos' => ['national/kazakh/22-1.jpg', 'national/kazakh/22-2.jpg', 'national/kazakh/22-3.jpg'],
                'categories' => [6],
            ],
            [
                'user_id' => 1,
                'price' => 15000,
                'photos' => ['national/kazakh/23-1.jpg', 'national/kazakh/23-2.jpg', 'national/kazakh/23-3.jpg'],
                'categories' => [6],
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
                'description' => 'Кішкене барқыт қара француз ұзын көйлек. Көйлектің желбезегі інжу-маржанмен кестеленген. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Жалдау мерзімі: күн.',
            ],
            [
                'dress_id' => 2,
                'language' => 'en',
                'title' => 'Evening corset dress for hire (different colors) in Almaty',
                'description' => 'Our famous tulle corset dresses fit perfectly. Lightweight and fluffy. Available in black, white, beige, purple, pink, raspberry (fuchsia) colors. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Size: 42-44, 46 size is available in black, raspberry (fuchsia), purple. Rental period: days.',
            ],
            [
                'dress_id' => 2,
                'language' => 'ru',
                'title' => 'Вечернее платье-корсет на прокат (разные цвета) в Алматы',
                'description' => 'Наши знаменитые фатиновые платья-корсеты идеально сидят по фигуре. Легкие и пышные. Есть в черном, белое, бежевом, фиолетовом, розовом, малиновом (фуксия) цветах. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: 42-44, 46 размер есть в черном, малиновом (фуксия), фиолетовом цвете. Срок проката: сутки.',
            ],
            [
                'dress_id' => 2,
                'language' => 'kk',
                'title' => 'Алматыда кешкі корсет көйлек жалға беріледі (түрлі түсті).',
                'description' => 'Біздің атақты тюль корсет көйлектеріміз тамаша жарасады. Жеңіл және жұмсақ. Қара, ақ, бежевый, күлгін, қызғылт, таңқурай (фуксия) түстері бар. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Өлшемі: 42-44, 46 размер қара, таңқурай (фуксия), күлгін түсті. Жалдау мерзімі: күн.',
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
                'description' => 'Ашық кешкі күлгін ұзын көйлек. Көйлекті автор кестелеген, дизайнын ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Жалдау мерзімі: күн.',
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
                'description' => '3 метр пойызы бар сары тюль көйлек фотосессияға, махаббат хикаясына өте ыңғайлы. Көйлек жеңіл, оны ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Жалдау мерзімі: күн.',
            ],
            [
                'dress_id' => 5,
                'language' => 'en',
                'title' => 'Фэмили лук Family look для мамы и дочки платья на фотосессию на прокат в Алматы',
                'description' => 'Фатиновые платья для мамы и дочки предназначены для создания семейных луков, праздничных фотосессией. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: взрослое - 42-46, детское - для ростовки 98-110 см.',
            ],
            [
                'dress_id' => 5,
                'language' => 'ru',
                'title' => 'Фэмили лук Family look для мамы и дочки платья на фотосессию на прокат в Алматы',
                'description' => 'Фатиновые платья для мамы и дочки предназначены для создания семейных луков, праздничных фотосессией. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: взрослое - 42-46, детское - для ростовки 98-110 см.',
            ],
            [
                'dress_id' => 5,
                'language' => 'kk',
                'title' => 'Фэмили лук Family look для мамы и дочки платья на фотосессию на прокат в Алматы',
                'description' => 'Фатиновые платья для мамы и дочки предназначены для создания семейных луков, праздничных фотосессией. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: взрослое - 42-46, детское - для ростовки 98-110 см.',
            ],
            [
                'dress_id' => 6,
                'language' => 'en',
                'title' => 'Pink dress with tie for hire (set) in Almaty',
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
                'title' => 'Blue dress with tie for hire (set) in Almaty',
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
                'title' => 'Red dress for hire (set) in Almaty',
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
                'title' => 'Red dress with tulip patterns for hire (set) in Almaty',
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
                'title' => 'Short camisole for hire in Almaty',
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
                'title' => 'Veil and uki feathers for hire',
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
                'title' => 'Saukele for hire',
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
                'title' => "Women's national ethnic costume for hire in Almaty",
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
                'description' => 'Түрлі түстердегі жеңіл әйелдер этно-жиынтықтары. Көк, қара көгілдір, фуксия және қою жасыл түсті. Негізгі көйлек, қалпақ және такия кіреді. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Өлшемі: 42-46. Жалдау мерзімі: күн',
            ],
            [
                'dress_id' => 16,
                'language' => 'en',
                'title' => "Women's national blue ethnic costume for rent in Almaty",
                'description' => "Light women's ethno-sets in different colors. There is blue, dark turquoise, fuchsia and dark green. Includes base dress, hat and takiya. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Size: 42-46. Rental period: day",
            ],
            [
                'dress_id' => 16,
                'language' => 'ru',
                'title' => 'Женский национальный голубой этно-костюм на прокат в Алматы',
                'description' => 'Легкие женские этно-комплекты в разных цветах. Есть голубой, темно-бирюзовый, в цвете фуксии и тёмно-зелёный. В комплект входит базовое платье, шапан и такия. Дизайн разработан модельером Алией Мусаевой из ApoltiStore. Размер: 42-46. Срок проката: сутки',
            ],
            [
                'dress_id' => 16,
                'language' => 'kk',
                'title' => 'Алматыда әйелдерге арналған ұлттық көгілдір этникалық киім жалға беріледі',
                'description' => 'Түрлі түстердегі жеңіл әйелдер этно-жиынтықтары. Көк, қара көгілдір, фуксия және қою жасыл түсті. Негізгі көйлек, қалпақ және такия кіреді. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Өлшемі: 42-46. Жалдау мерзімі: күн',
            ],
            [
                'dress_id' => 17,
                'language' => 'en',
                'title' => "Women's national dark green ethnic costume for rent in Almaty",
                'description' => "Light women's ethno-sets in different colors. There is blue, dark turquoise, fuchsia and dark green. Includes base dress, hat and takiya. The design was developed by fashion designer Aliya Musayeva from ApoltiStore. Size: 42-46. Rental period: day",
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
                'description' => 'Түрлі түстердегі жеңіл әйелдер этно-жиынтықтары. Көк, қара көгілдір, фуксия және қою жасыл түсті. Негізгі көйлек, қалпақ және такия кіреді. Дизайнды ApoltiStore дүкенінен сәнгер Әлия Мұсаева жасаған. Өлшемі: 42-46. Жалдау мерзімі: күн',
            ],

        ];

        DressTranslation::insert($dressesTranslations);
    }


}
