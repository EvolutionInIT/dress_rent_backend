<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Resources\V1\Client\Currency\CurrencyResource;
use App\Models\V1\Currency;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class CurrencyControllerClient
{
    /**
     * @return AnonymousResourceCollection
     */
    public function list(): AnonymousResourceCollection
    {
        $currency =
            Currency
                ::select('currency_id', 'code', 'symbol')
                ->with('translation:currency_id,title')
                ->get();

        return CurrencyResource::collection($currency);
    }
}
