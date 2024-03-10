<?php

namespace App\Http\Services\V1\Client;

use App\Http\Services\V1\Common\CommonService;
use App\Http\Services\V1\Common\ImageService;
use App\Models\V1\Dress;
use App\Models\V1\DressCategory;
use App\Models\V1\DressColor;
use App\Models\V1\DressSize;
use App\Models\V1\Photo;

class DressCatalogClientService extends CommonService
{
    /**
     * @param $requestData
     * @param string $method
     * @return mixed
     */
    public static function get($requestData, string $method = 'first'): mixed
    {
        $query =
            Dress
                ::when($requestData['dress_id'] ?? false, function ($q) use ($requestData) {
                    $q->where('dress_id', $requestData['dress_id']);
                })
                ->when($requestData['category_id'] ?? null, function ($q) use ($requestData) {
                    $q->whereHas('categories', function ($q) use ($requestData) {
                        $q->where('category.category_id', $requestData['category_id']);
                    });
                })
                ->when($requestData['color_id'] ?? null, function ($q) use ($requestData) {
                    $q->whereHas('colors', function ($q) use ($requestData) {
                        $q->where('color.color_id', $requestData['color_id']);
                    });
                })
                ->when($requestData['size_id'] ?? null, function ($q) use ($requestData) {
                    $q->whereHas('sizes', function ($q) use ($requestData) {
                        $q->where('size.size_id', $requestData['size_id']);
                    });
                })
                ->when($requestData['user_id'] ?? null, function ($q) use ($requestData) {
                    $q->where('user_id', $requestData['user_id']);
                })
                ->with('translation:dress_id,title,description')
                ->with('translations')
                ->with('categories.translation:category_id,title')
                ->with('photos')
                ->with('sizes:size_id,size')
                ->with('colors.translation')
                ->with('component.translation:component_id,title,description')
                ->with('price');

        if ($method === 'first')
            return $query->first();
        //else if ($method === 'list')
        return $query->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);
    }

    /**
     * @param $modelClass
     * @param array $requestData
     * @return Dress
     */
    public static function save($modelClass, array $requestData): Dress
    {
        $dress = parent::save($modelClass, $requestData);
        self::saveCategoriesColorsSizes($dress, $requestData);
        self::storeOptimizeImages($dress, $requestData);
        return $dress;
    }

    /**
     * @param $modelClass
     * @param array $requestData
     * @return Dress
     */
    public static function update($modelClass, array $requestData): Dress
    {
        $dress = parent::update($modelClass, $requestData);
        $dress->categories()->delete();
        $dress->sizes()->delete();
        $dress->colors()->delete();
        self::saveCategoriesColorsSizes($dress, $requestData);
        self::storeOptimizeImages($dress, $requestData);
        return $dress;
    }

    /**
     * @param Dress $dress
     * @param array $requestData
     * @return void
     */
    public static function saveCategoriesColorsSizes(Dress $dress, array $requestData): void
    {
        $arrCategory = [];
        foreach ($requestData['categories'] as $category) {
            $arrCategory[] = [
                'dress_id' => $dress->dress_id,
                'category_id' => $category
            ];
        }
        DressCategory::insert($arrCategory);

        $arrColor = [];
        foreach ($requestData['colors'] as $color) {
            $arrColor [] = [
                'dress_id' => $dress->dress_id,
                'color_id' => $color
            ];
        }
        DressColor::insert($arrColor);

        $arrSize = [];
        foreach ($requestData['sizes'] as $size) {
            $arrSize [] = [
                'dress_id' => $dress->dress_id,
                'size_id' => $size
            ];
        }
        DressSize::insert($arrSize);
    }

    /**
     * @param Dress $dress
     * @param array $requestData
     * @return void
     */
    public static function storeOptimizeImages(Dress $dress, array $requestData): void
    {
        $arrPhoto = [];
        $widthBig = $requestData['width_big'] ?? '800';
        $widthSmall = $requestData['width_small'] ?? '300';

        $prefixFullPath = 'public/dress/user/' . $requestData['user_id'] . '/rent/dress/' . $dress->dress_id . '/';
        foreach ($requestData['photos'] as $photo) {

            $photoBigName = ImageService::saveOptimizeImage($photo, $prefixFullPath, width: $widthBig);
            $photoSmallName = ImageService::saveOptimizeImage($photo, $prefixFullPath, width: $widthSmall);

            $arrPhoto [] = [
                'dress_id' => $dress->dress_id,
                'image' => $photoBigName,
                'image_small' => $photoSmallName,
            ];
        }
        if (count($arrPhoto)) Photo::insert($arrPhoto);
    }
}
