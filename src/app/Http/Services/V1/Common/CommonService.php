<?php

namespace App\Http\Services\V1\Common;

class CommonService
{

    /**
     * Create a new model record with translations.
     *
     * @param $modelClass
     * @param array $requestData
     * @return mixed
     */
    public static function save($modelClass, array $requestData): mixed
    {
        $record = $modelClass::create($requestData);

        self::saveTranslations($record, translations: $requestData['translations']);

        return $record;
    }


    /**
     * @param $modelClass
     * @param array $requestData
     * @return mixed
     */
    public static function update($modelClass, array $requestData): mixed
    {
        $record =
            $modelClass
                ::where($modelClass::getPrimaryKeyName(), $requestData[$modelClass::getPrimaryKeyName()])
                ->first();
        $record->update($requestData);

        $record->translations()->delete();
        self::saveTranslations($record, translations: $requestData['translations']);

        return $record;
    }

    /**
     * @param $record
     * @param $translations
     * @return void
     */
    public static function saveTranslations(&$record, $translations): void
    {
        if (isset($translations) && is_array($translations)) {
            foreach ($translations as $key => &$translation)
                $translation['language'] = $key;
            $record->translations()->createMany($translations);
        }

//        $record->load('translation');
//        $record->load('translations');
    }

}
