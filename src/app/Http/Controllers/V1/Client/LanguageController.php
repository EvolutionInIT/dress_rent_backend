<?php

namespace App\Http\Controllers\V1\Client;

use App\Models\Language;
use App\Http\Resources\V1\Client\Language\LanguageCollection;


class LanguageController
{
    /**
     * @return LanguageCollection
     */
    public function list(): LanguageCollection
    {
        $language =
            Language
                ::where('show', true)
                ->get();

        return new LanguageCollection($language);
    }
}
