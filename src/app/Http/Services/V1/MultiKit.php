<?php

namespace App\Http\Services\V1;

class MultiKit
{

    /**
     * Create a new model record with translations.
     *
     * @param $modelClass
     * @param array $requestData
     * @return mixed
     */
    public static function multiCreate($modelClass, array $requestData): mixed
    {
        $model = $modelClass::create($requestData);

        if (isset($requestData['translations'])) {
            foreach ($requestData['translations'] as &$translation) {
                $translation[$model->_id] = $model::getPrimaryKeyName();
            }
            $model->translations()->createMany($requestData['translations']);
        }
        return $model->load('translations');
    }


    /**
     * @param $modelClass
     * @param array $requestData
     * @return mixed
     */
    public static function multiUpdate($modelClass, array $requestData): mixed
    {
        $model = $modelClass
            ::where($modelClass::getPrimaryKeyName(), $requestData[$modelClass::getPrimaryKeyName()])
            ->first();
        $model->update($requestData);

        if (isset($requestData['translations'])) {
            foreach ($requestData['translations'] as &$translation) {
                $translation[$model->_id] = $model::getPrimaryKeyName();
            }
            $model->translations()->delete();
            $model->translations()->createMany($requestData['translations']);
        }
        return $model->load('translations');
    }

}
