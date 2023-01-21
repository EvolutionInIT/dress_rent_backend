<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dress\ListDressRequest;
use App\Http\Requests\Dress\SaveDressRequest;
use App\Http\Resources\Dress\DressCollection;
use App\Http\Resources\Dress\DressResource;
use App\Models\Dress;
use App\Models\DressCategory;
use App\Models\DressColor;
use App\Models\DressSize;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DressController
{
    /**
     * @param SaveDressRequest $request
     * @return DressResource
     */
    public function save(SaveDressRequest $request): DressResource
    {
        $requestData = $request->validated();

        $categoryIds = $requestData['category_id'] ?? [];
        $colorIds = $requestData['color_id'] ?? [];
        $sizeIds = $requestData['size_id'] ?? [];
        $photoIds = $requestData['photo'] ?? [];


        $dress = Dress::create([
            'title' => $requestData['title'],
            'description' => $requestData['description'],
            'user_id' => $requestData['user_id']
        ]);

        $arrCategory = [];
        foreach ($categoryIds as $category) {
            $arrCategory[] = [
                'dress_id' => $dress->dress_id,
                'category_id' => $category
            ];
        }
        DressCategory::insert($arrCategory);

        $arrColor = [];
        foreach ($colorIds as $color) {
            $arrColor [] = [
                'dress_id' => $dress->dress_id,
                'color_id' => $color
            ];
        }
        DressColor::insert($arrColor);

        $arrSize = [];
        foreach ($sizeIds as $size) {
            $arrSize [] = [
                'dress_id' => $dress->dress_id,
                'size_id' => $size
            ];
        }
        DressSize::insert($arrSize);

        $arrPhoto = [];
        foreach ($photoIds as $photo) {
            $photoName = $photo->store('dress');
            $photoName = substr($photoName, 6);

            $arrPhoto [] = [
                'dress_id' => $dress->dress_id,
                'image' => $photoName,
                'image_small' => $photoName
            ];
        }
        Photo::insert($arrPhoto);


        $dress->category;
        $dress->color;
        $dress->size;
        $dress->photo;

        return new DressResource($dress);

    }

    public function get(ListDressRequest $request): JsonResponse
    {
        $dressID = $request->validated()['dress_id'] ?? null;

        $dress = Dress
            ::when($dressID, function ($q) use ($dressID) {
                $q->where('dress_id', $dressID);
            })
            ->get();

        if ($dress)
            return response()->json(['data' => $dress->toArray()], ResponseAlias::HTTP_OK);
        else
            return response()->json(['error' => 'dress_get_error'], ResponseAlias::HTTP_BAD_GATEWAY);
    }

    public function list(ListDressRequest $request): DressCollection
    {
        $requestData = $request->validated();

        $page = $requestData['page'] ?? 1;
        $perPage = $requestData['per_page'] ?? 10;

        $categoryID = $requestData['category_id'] ?? null;
        $userID = $requestData['user_id'] ?? null;
        $colorID = $requestData['color_id'] ?? null;
        $sizeID = $requestData['size_id'] ?? null;
        //$photoID = $requestData['photo_id'] ?? null;

        $dress = Dress
            ::select()
            ->when($categoryID, function ($q) use ($categoryID) {

                $q->whereHas('category', function ($q) use ($categoryID) {
                    $q->where('dress_category.category_id', $categoryID);
                });
            })
            ->when($colorID, function ($q) use ($colorID) {

                $q->whereHas('color', function ($q) use ($colorID) {
                    $q->where('dress_color.color_id', $colorID);
                });
            })
            ->when($sizeID, function ($q) use ($sizeID) {

                $q->whereHas('size', function ($q) use ($sizeID) {
                    $q->where('dress_size.size_id', $sizeID);
                });
            })
            ->when($userID, function ($q) use ($userID) {
                $q->where('user_id', $userID);
            })
            ->with('category:category_id,title,description')
            ->with('user:user_id,name')
            ->with('color:color_id,color')
            ->with('size:size_id,size')
            ->with('photo')
            ->paginate($perPage, $page);

        return new DressCollection($dress);

    }

//    public function delete(ListDressRequest $request): JsonResponse
//    {
//        $dressID = $request->validated()['dress_id'] ?? null;
//
//        $dress = Dress
//            ::where('dress_id', $dressID)
//            ->delete();
//
//        if ($dress)
//            return response()->json(['message' => 'ok'], ResponseAlias::HTTP_OK);
//        else
//            return response()->json(['error' => 'dress_delete_error'], ResponseAlias::HTTP_BAD_GATEWAY);
//    }


    public function delete(): JsonResponse
    {
        $dressID = request('dress_id');

        $dress = Dress::where('dress_id', $dressID)->delete();

        if ($dress)
            return response()->json(['message' => 'deleted'], ResponseAlias::HTTP_OK);
        else
            return response()->json(['error' => 'dress_delete_error'], ResponseAlias::HTTP_BAD_GATEWAY);
    }


}




















