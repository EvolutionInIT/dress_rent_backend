<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\SaveUserRequest;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function save(SaveUserRequest $request): \Illuminate\Http\JsonResponse
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
