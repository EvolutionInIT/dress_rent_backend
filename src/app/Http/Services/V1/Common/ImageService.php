<?php

namespace App\Http\Services\V1\Common;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageService
{
    /**
     * @param $file
     * @param $prefixFullPath
     * @param $width
     * @return string
     */
    public static function saveOptimizeImage($file, $prefixFullPath, $width): string
    {
        $width = intval($width);
        $storage = Storage::disk('public');
        if (!$storage->exists($prefixFullPath))
            $storage->makeDirectory($prefixFullPath);

        if (is_file($file)) {
            $photoPath = $storage->put($prefixFullPath, $file, 'public');
            $path = $storage->path('/') . $photoPath;
            //$pathToOptimizedImage = substr($path, 0, strlen($path) - 4) . 'optimize.jpg';
            $image = Image::read($path);

            $width = $image->width() > $image->height() ? $width * 2 : $width;

            $image->scaleDown($width)
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
