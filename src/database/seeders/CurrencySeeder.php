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
        //Currency::truncate();

        $currencies = [
            [
                'symbol' => '₸',
                'code' => 'KZT',
                'iban_code' => '398',
            ],
            [
                'symbol' => '₽',
                'code' => 'RUB',
                'iban_code' => '826',
            ],
            [
                'symbol' => '$',
                'code' => 'USD',
                'iban_code' => '840',
            ],
            [
                'symbol' => '€',
                'code' => 'EUR',
                'iban_code' => '978',
            ],
            [
                'symbol' => '£',
                'code' => 'GBP',
                'iban_code' => '826',
            ],

        ];

        foreach ($currencies as &$currency)
            $currency =
                [
                    ...$currency,
                    ...[
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                ];

        Currency::insert($currencies);

        $defaultCurrencies =
            explode(
                ',',
                env('INSTALL_CURRENCY_CODES_ENABLED', 'USD,RUB,KZT')
            );

        Currency
            ::whereNotIn('code', $defaultCurrencies)
            ->update(['enabled' => false]);

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
