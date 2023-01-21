<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\DeletePhotoRequest;
use App\Http\Requests\Photo\ListPhotoRequest;
use App\Http\Requests\Photo\PhotoRequest;
use App\Http\Requests\Photo\SavePhotoRequest;
use App\Http\Resources\Photo\PhotoCollection;
use App\Http\Resources\Photo\PhotoResource;
use App\Models\Photo;

class PhotoController extends Controller
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


//    public function save(SavePhotoRequest $request): PhotoResource
//    {
//        $requestData = $request->validated();
//        $photoIds = $requestData['photo'] ?? [];
//
//
//        $arrPhoto = [];
//        foreach ($photoIds as $photo) {
//            $photoName = $photo->store('dresses');
//            $photoName = substr($photoName, 6);
//
//            $arrPhoto [] = [
//                'image' => $photoName,
//                'image_small' => $photoName
//            ];
//
//        }
//
//
//        //dd($arrPhoto);
//
//        Photo::insert($arrPhoto);
//
//        //dd(Photo::insert($arrPhoto));
//
//        return new PhotoResource($arrPhoto);
//    }


    public function save(SavePhotoRequest $request): PhotoResource
    {
        $requestData = $request->validated();
        $photoIds = $requestData['photo'] ?? [];


        $arrPhoto = [];
        foreach ($photoIds as $photo) {
            $photoName = $photo->store('dresses');
            $photoName = substr($photoName, 6);
        }

        $photo = Photo::create(
            $arrPhoto [] = [
                'image' => $photoName,
                'image_small' => $photoName
            ]
        );

        return new PhotoResource($photo);
    }


    public function list(ListPhotoRequest $request): PhotoCollection
    {
        $requestData = $request->validated();

        $photo = Photo
            ::select()
            ->when($requestData['dress_id'] ?? null, function ($q) use ($requestData) {
                $q->where('dress_id', $requestData['dress_id']);
            })
            ->with('dress:dress_id,title,description')
            ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new PhotoCollection($photo);
    }


    public function delete(DeletePhotoRequest $request): PhotoResource
    {
        $requestData = $request->validated();

        $photo = Photo
            ::where('photo_id', $requestData['photo_id'])
            ->delete();

        return new PhotoResource($photo);
    }
}
