<?php

namespace App\Http\Services\V1\Common;

use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageService
{
    /**
     * @param $photo
     * @param $prefixFullPath
     * @param $width
     * @return string
     */
    public static function saveOptimizeImage($photo, $prefixFullPath, $width): string
    {
        if (is_file($photo)) {
            $photoPath = $photo->storeAs($prefixFullPath, Str::random(40) . '.' . $photo->extension());
            $path = '/var/www/storage/app/' . $photoPath;
            //$pathToOptimizedImage = substr($path, 0, strlen($path) - 4) . 'optimize.jpg';
            Image
                ::read($path)
                ->scaleDown($width)
//                ->toWebp(90)->save($path . '.webp');
                ->save(quality: 100);
            ImageOptimizer::optimize($path);
            //ImageOptimizer::optimize($path, $pathToOptimizedImage);
            $photoName = explode("/", $photoPath);
            return $photoName[count($photoName) - 1];
        }
        return '';
    }
}
