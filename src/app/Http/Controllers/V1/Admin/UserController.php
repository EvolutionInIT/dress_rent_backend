<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Requests\V1\Admin\User\DeleteUserRequest;
use App\Http\Requests\V1\Admin\User\ListUserRequest;
use App\Http\Requests\V1\Admin\User\SaveUserRequest;
use App\Http\Requests\V1\Admin\User\UserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\V1\User\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController
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
            ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new UserCollection($user);
    }


    public function delete(DeleteUserRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        User::where('user_id', $requestData['user_id'])->delete();

        return response()->json(['data' => ['message' => 'success']], ResponseAlias::HTTP_OK);
    }

}
