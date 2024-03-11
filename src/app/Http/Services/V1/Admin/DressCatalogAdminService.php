<?php

namespace App\Http\Services\V1\Admin;

use App\Http\Services\V1\Common\CommonService;
use App\Http\Services\V1\Common\ImageService;
use App\Models\V1\Dress;
use App\Models\V1\DressPrice;
use App\Models\V1\Photo;

class DressCatalogAdminService extends CommonService
{
    /**
     * @param $requestData
     * @param string $method
     * @param string $order
     * @param bool $withPrice
     * @param bool $withPrices
     * @return mixed
     */
    public static function get($requestData, string $method = 'first', string $order = 'asc', $withPrice = false, $withPrices = false): mixed
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
                ->when($withPrice ?? false, function ($q) {
                    $q->with('price');
                })
                ->when($withPrices ?? false, function ($q) {
                    $q->with('prices.translation');
                })
                ->orderBy('dress_id', $order ?? 'asc');

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
        $dress->categories()->detach();
        $dress->sizes()->detach();
        $dress->colors()->detach();
        $dress->prices()->detach();
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
        $dress->categories()->attach($requestData['categories']);
        $dress->colors()->attach($requestData['colors']);
        $dress->sizes()->attach($requestData['sizes']);

        $pricesArr = [];
        foreach ($requestData['prices'] ?? [] as $key => $item) {
            $pricesArr[] = [
                'dress_id' => $dress->dress_id,
                'price' => $item,
                'code' => $key,
            ];
        }
        if (count($pricesArr)) DressPrice::insert($pricesArr);
    }

    /**
     * @param Dress $dress
     * @param array $requestData
     * @return void
     */
    public static function storeOptimizeImages(Dress $dress, array $requestData): void
    {
        $arrPhoto = [];
        $widthBig = $requestData['width_big'] ?? env('RENT_DRESS_BIG_UPLOAD_SIZE', 800);
        $widthSmall = $requestData['width_small'] ?? env('RENT_DRESS_SMALL_UPLOAD_SIZE', 400);

        $prefixFullPath = 'user/' . $dress->user_id . '/rent/dress/' . $dress->dress_id . '/';

        foreach ($requestData['photos'] ?? [] as $photo) {

            $photo2 = clone $photo;

            $photoBigName = ImageService::saveOptimizeImage($photo, $prefixFullPath, width: $widthBig);
            $photoSmallName = ImageService::saveOptimizeImage($photo2, $prefixFullPath, width: $widthSmall);

            $arrPhoto [] = [
                'dress_id' => $dress->dress_id,
                'image' => $photoBigName,
                'image_small' => $photoSmallName,
            ];
        }
        if (count($arrPhoto)) Photo::insert($arrPhoto);
    }
}
