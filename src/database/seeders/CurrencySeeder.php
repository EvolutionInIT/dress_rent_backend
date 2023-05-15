<?php

namespace Database\Seeders;

use App\Models\V1\Currency;
use App\Models\V1\CurrencyTranslation;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->generateCurrency();

    }

    public function generateCurrency()
    {
        $currencies = [
            [
                "code" => "KZT",
                'symbol' => '₸'
            ],
            [
                "code" => "RUB",
                'symbol' => '₽'
            ],
            [
                "code" => "USD",
                'symbol' => '$'
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::create(
                [
                    ...$currency,
                    ...[
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                ]
            );
        }

        $defaultCurrency =
            env('INSTALL_CURRENCY_CODES_SHOW',)
                ? explode(',', env('INSTALL_CURRENCY_CODES_SHOW', 'KZT'))
                : ['KZT', 'RUB', 'USD'];

        Currency
            ::whereIn('code', $defaultCurrency)
            ->update(['show' => true]);

        $this->generateCurrencyTranslation();
    }

    public function generateCurrencyTranslation()
    {
        $currenciesTranslations = [
            [
                "currency_id" => 1,
                "title" => "Tenge",
                "language" => "en"
            ],
            [
                "currency_id" => 1,
                "title" => "Тенге",
                "language" => "ru"
            ],
            [
                "currency_id" => 1,
                "title" => "Теңге",
                "language" => "kk"
            ],
            [
                "currency_id" => 2,
                "title" => "Ruble",
                "language" => "en"
            ],
            [
                "currency_id" => 2,
                "title" => "Рубль",
                "language" => "ru"
            ],
            [
                "currency_id" => 2,
                "title" => "Рубль",
                "language" => "kk"
            ],
            [
                "currency_id" => 3,
                "title" => "Dollar",
                "language" => "en"
            ],
            [
                "currency_id" => 3,
                "title" => "Доллар",
                "language" => "ru"
            ],
            [
                "currency_id" => 3,
                "title" => "Доллар",
                "language" => "kk"
            ],
        ];

        CurrencyTranslation::insert($currenciesTranslations);
    }
}
