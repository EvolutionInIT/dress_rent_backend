<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Resources\V1\Client\Language\LanguageResource;
use App\Models\V1\Language;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class LanguageControllerClient
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
