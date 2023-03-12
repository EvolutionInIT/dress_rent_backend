<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Resources\V1\Client\Language\LanguageResource;
use App\Models\Language;
use App\Http\Resources\V1\Client\Language\LanguageCollection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class LanguageController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function list(): AnonymousResourceCollection
    {
        $language =
            Language
                ::select('language_id', 'title', 'code')
                ->where('show', true)
                ->get();

        return LanguageResource::collection($language);
    }
}
