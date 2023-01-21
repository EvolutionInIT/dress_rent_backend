<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\ListUserRequest;
use App\Http\Requests\User\SaveUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class UserController extends Controller
{

    public function get(UserRequest $request): UserResource
    {
        $requestData = $request->validated();

        $user = User
            ::when($requestData['user_id'] ?? null, function ($q) use ($requestData) {
                $q->where('user_id', $requestData['user_id']);
            })
            ->first();

        return new UserResource($user);
    }


    public function save(SaveUserRequest $request): UserResource
    {
        $requestData = $request->validated();

        $user = User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            //'email_verified_at' => $requestData['email_verified_at'],
            'password' => $requestData['password'],
        ]);

        return new UserResource($user);
    }


    public function list(ListUserRequest $request): UserCollection
    {
        $requestData = $request->validated();

        $user = User
            ::select()
            ->when($requestData['dress_id'] ?? null, function ($q) use ($requestData) {
                $q->where('dress_id', $requestData['dress_id']);
            })
            ->with('dress:dress_id,title,description')
            ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new UserCollection($user);
    }


    public function delete(DeleteUserRequest $request): UserResource
    {
        $requestData = $request->validated();

        $user = User
            ::where('user_id', $requestData['user_id'])
            ->delete();

        return new UserResource($user);
    }

}
