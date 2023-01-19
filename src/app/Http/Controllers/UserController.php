<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dress\ListDressRequest;
use App\Http\Requests\User\ListUserRequest;
use App\Http\Requests\User\SaveUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function get(listDressRequest $request): JsonResponse
    {
        $userID = $request->validated()['user_id'] ?? null;

        $user = User
            ::when($userID, function ($q) use ($userID) {
                $q->where('user_id', $userID);
            })
            ->get();

        if ($user)
            return response()->json(['data' => $user->toArray()], ResponseAlias::HTTP_OK);
        else
            return response()->json(['error' => 'user_get_error'], ResponseAlias::HTTP_BAD_GATEWAY);

    }

    public function save(SaveUserRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        $user = User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'email_verified_at' => $requestData['email_verified_at'],
            'password' => $requestData['password'],
        ]);

        if ($user)
            return response()->json(['data' => $user->toArray()], ResponseAlias::HTTP_OK);
        else
            return response()->json(['error' => 'user_save_error'], ResponseAlias::HTTP_BAD_GATEWAY);

    }

    public function list(ListUserRequest $request): UserCollection
    {
        $requestData = $request->validated();
        $page = $requestData['page'] ?? 1;
        $perPage = $requestData['per_page'] ?? 10;
        $dressID = $requestData['dress_id'] ?? null;

        $user = User
            ::select()
            ->when($dressID, function ($q) use ($dressID) {
                $q->where('dress_id', $dressID);
            })
            ->with('dress:dress_id,title,description')
            ->paginate($perPage, $page);

        return new UserCollection($user);
    }

    public function delete(ListUserRequest $request): JsonResponse
    {
        $userID = $request->validated()['user_id'];

        $user = User
            ::where('user_id', $userID)
            ->delete();

        if ($user)
            return response()->json(['message' => 'deleted'], ResponseAlias::HTTP_OK);
        else
            return response()->json(['error' => 'user_delete_error'], ResponseAlias::HTTP_BAD_GATEWAY);
    }

}
