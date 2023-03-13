<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Requests\V1\Admin\Photo\DeletePhotoRequest;
use App\Http\Requests\V1\Admin\Photo\ListPhotoRequest;
use App\Http\Requests\V1\Admin\Photo\PhotoRequest;
use App\Http\Resources\V1\Admin\Photo\PhotoCollection;
use App\Http\Resources\V1\Admin\Photo\PhotoResource;
use App\Models\V1\Photo;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PhotoController
{
    public function get(PhotoRequest $request): PhotoResource
    {
        $requestData = $request->validated();

        $photo = Photo
            ::when($requestData['photo_id'] ?? null, function ($q) use ($requestData) {
                $q->where('photo_id', $requestData['photo_id']);
            })->first();

        return new PhotoResource($photo);
    }

    public function list(ListPhotoRequest $request): PhotoCollection
    {
        $requestData = $request->validated();

        $photo = Photo
            ::select()
            ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new PhotoCollection($photo);
    }

    public function delete(DeletePhotoRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        Photo::where('photo_id', $requestData['photo_id'])->delete();

        return response()->json(['data' => ['message' => 'success']], ResponseAlias::HTTP_OK);
    }
}
