<?php

namespace Database\Seeders;

use App\Models\V1\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->generateLanguages();
    }

    public function generateLanguages()
    {
        $languages = [
            ["title" => "Afrikaans", "code" => "an"],
            ["title" => "Azəri", "code" => "az"],
            ["title" => "Bahasa Melayu", "code" => "ma"],
            ["title" => "Basa Jawa", "code" => "iz"],
            ["title" => "Čeština", "code" => "ch"],
            ["title" => "Dansk", "code" => "dt"],
            ["title" => "Deutsch", "code" => "de"],
            ["title" => "Eesti", "code" => "et"],
            ["title" => "English", "code" => "en"],
            ["title" => "Español", "code" => "es"],
            ["title" => "Filipino", "code" => "fp"],
            ["title" => "Français", "code" => "fr"],
            ["title" => "Hrvatski", "code" => "hr"],
            ["title" => "Íslenska", "code" => "il"],
            ["title" => "Italiano", "code" => "it"],
            ["title" => "Latviešu", "code" => "lt"],
            ["title" => "Lietuvių", "code" => "li"],
            ["title" => "Magyar", "code" => "vg"],
            ["title" => "Malagasy", "code" => "md"],
            ["title" => "Malti", "code" => "mt"],
            ["title" => "Nederlands", "code" => "nd"],
            ["title" => "Norsk", "code" => "nr"],
            ["title" => "O‘zbek", "code" => "uz"],
            ["title" => "Polski", "code" => "pl"],
            ["title" => "Português", "code" => "pt"],
            ["title" => "Română", "code" => "rm"],
            ["title" => "Shona", "code" => "zw"],
            ["title" => "Slovenčina", "code" => "sv"],
            ["title" => "Slovenščina", "code" => "sn"],
            ["title" => "Svenska", "code" => "sk"],
            ["title" => "Tiếng Việt", "code" => "vn"],
            ["title" => "Türkçe", "code" => "tk"],
            ["title" => "Yorùbá", "code" => "ng"],
            ["title" => "Ελληνικά", "code" => "gr"],
            ["title" => "Беларуская", "code" => "bl"],
            ["title" => "Български", "code" => "bi"],
            ["title" => "Кыргызча", "code" => "kg"],
            ["title" => "Қазақша", "code" => "kk"],
            ["title" => "Русский", "code" => "ru"],
            ["title" => "Српски", "code" => "sr"],
            ["title" => "Татарча", "code" => "tt"],
            ["title" => "Тоҷикӣ", "code" => "tj"],
            ["title" => "Українська", "code" => "ua"],
            ["title" => "ქართული", "code" => "gz"],
            ["title" => "Հայերեն", "code" => "am"],
            ["title" => "‏עברית", "code" => "iv"],
            ["title" => "اردو", "code" => "pn"],
            ["title" => "العربية", "code" => "ar"],
            ["title" => "پښتو", "code" => "af"],
            ["title" => "فارسی", "code" => "ir"],
            ["title" => "አማርኛ", "code" => "ef"],
            ["title" => "नेपाली", "code" => "np"],
            ["title" => "हिन्दी", "code" => "in"],
            ["title" => "চাটগাঁইয়া বুলি", "code" => "bg"],
            ["title" => "বাংলা", "code" => "be"],
            ["title" => "සිංහල", "code" => "sl"],
            ["title" => "ພາສາລາວ", "code" => "la"],
            ["title" => "中文", "code" => "cn"],
            ["title" => "日本語", "code" => "ja"],
            ["title" => "한국어", "code" => "ko"]
        ];

        foreach ($languages as $key => &$language) {
            $language['position'] = $key + 1;
            $language['created_at'] = now();
            $language['updated_at'] = now();
        }

        Language::insert($languages);

        $defaultLanguages = explode(',', env('INSTALL_LANGUAGE_CODES_ENABLED', 'en,ru,kk'));

        Language
            ::whereNotIn('code', $defaultLanguages)
            ->update(['enabled' => false]);
    }
}
