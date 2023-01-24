<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dress\DeleteDressRequest;
use App\Http\Requests\Dress\DressRequest;
use App\Http\Requests\Dress\ListDressRequest;
use App\Http\Requests\Dress\SaveDressRequest;
use App\Http\Requests\Dress\UpdateDressRequest;
use App\Http\Resources\Dress\DressCollection;
use App\Http\Resources\Dress\DressResource;
use App\Models\Dress;
use App\Models\DressCategory;
use App\Models\DressColor;
use App\Models\DressSize;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DressController
{

    public function get(DressRequest $request): DressResource
    {
        $dressID = $request->validated()['dress_id'] ?? null;

        $dress = Dress
            ::when($dressID, function ($q) use ($dressID) {
                $q->where('dress_id', $dressID);
            })
            ->first();

        return new DressResource($dress);

    }


    /**
     * @param SaveDressRequest $request
     * @return DressResource
     */
    public function save(SaveDressRequest $request): DressResource
    {
        $requestData = $request->validated();

        $dress = Dress::create($requestData);

        $arrCategory = [];
        foreach ($requestData['category_id'] ?? [] as $category) {
            $arrCategory[] = [
                'dress_id' => $dress->dress_id,
                'category_id' => $category
            ];
        }
        DressCategory::insert($arrCategory);

        $arrColor = [];
        foreach ($requestData['color_id'] ?? [] as $color) {
            $arrColor [] = [
                'dress_id' => $dress->dress_id,
                'color_id' => $color
            ];
        }
        DressColor::insert($arrColor);

        $arrSize = [];
        foreach ($requestData['size_id'] ?? [] as $size) {
            $arrSize [] = [
                'dress_id' => $dress->dress_id,
                'size_id' => $size
            ];
        }
        DressSize::insert($arrSize);

        $arrPhoto = [];
        foreach ($requestData['photo'] ?? [] as $photo) {
            $photoName = $photo->store('dresses');
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


    public function update(UpdateDressRequest $request): DressResource
    {
        $requestData = $request->validated();

        $dress =
            Dress
                ::where('dress_id', $requestData['dress_id'])
                ->update($requestData);

        return new DressResource($dress);

    }


    /**
     * @param ListDressRequest $request
     * @return DressCollection
     */
    public function list(ListDressRequest $request): DressCollection
    {
        $requestData = $request->validated();

        $dress = Dress
            ::select()
            ->when($requestData['category_id'] ?? null, function ($q) use ($requestData) {
                $q->whereHas('category', function ($q) use ($requestData) {
                    $q->where('category.category_id', $requestData['category_id']);
                });
            })
            ->when($requestData['color_id'] ?? null, function ($q) use ($requestData) {
                $q->whereHas('color', function ($q) use ($requestData) {
                    $q->where('color.color_id', $requestData['color_id']);
                });
            })
            ->when($requestData['size_id'] ?? null, function ($q) use ($requestData) {
                $q->whereHas('size', function ($q) use ($requestData) {
                    $q->where('size.size_id', $requestData['size_id']);
                });
            })
            ->when($requestData['user_id'] ?? null, function ($q) use ($requestData) {
                $q->where('user_id', $requestData['user_id']);
            })
            ->with('category:category_id,title,description')
            ->with('color:color_id,color')
            ->with('size:size_id,size')
            ->with('photo')
            ->with('user:user_id,name')
            ->with('booking')
            ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new DressCollection($dress);
    }

    public function delete(DeleteDressRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Dress
            ::where('dress_id', $requestData['dress_id'])
            ->delete();

        return response()->json(['data' => ['message' => 'success']], Response::HTTP_OK);
    }

}




















