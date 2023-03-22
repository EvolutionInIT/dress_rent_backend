<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Requests\V1\Admin\Dress\DeleteDressRequest;
use App\Http\Requests\V1\Admin\Dress\DressRequest;
use App\Http\Requests\V1\Admin\Dress\ListDressRequest;
use App\Http\Requests\V1\Admin\Dress\SaveDressRequest;
use App\Http\Requests\V1\Admin\Dress\UpdateDressRequest;
use App\Http\Resources\V1\Admin\Dress\DressCollection;
use App\Http\Resources\V1\Admin\Dress\DressResource;
use App\Http\Services\V1\MultiKit;
use App\Models\V1\Dress;
use App\Models\V1\DressCategory;
use App\Models\V1\DressColor;
use App\Models\V1\DressSize;
use App\Models\V1\Photo;
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
            ->with('translation')
            ->with('category')
            ->with('photo')
            ->with('size')
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

        $dress =
            MultiKit
                ::multiCreate(Dress::class, $requestData);

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


    /**
     * @param UpdateDressRequest $request
     * @return DressResource
     */
    public function update(UpdateDressRequest $request): DressResource
    {
        $dress =
            MultiKit
                ::multiUpdate(Dress::class, $request->validated());

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
            ->with('component.translation:component_id,title,description')
            ->with('category.translation:category_id,title')
            ->with('translation:dress_id,title,description')
            ->with('color.translation:color_id,color')
            ->with('size:size_id,size')
            ->with('photo')
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




















