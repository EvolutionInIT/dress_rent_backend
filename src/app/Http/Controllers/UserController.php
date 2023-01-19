<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dress\ListDressRequest;
use App\Http\Requests\User\SaveUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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
            return response()->json(['data' => $user->toArray()], Response::HTTP_OK);
        else
            return response()->json(['error' => 'user_save_error'], Response::HTTP_BAD_GATEWAY);

    }

}
