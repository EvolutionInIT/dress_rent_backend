<?php

namespace App\Http\Controllers;

use App\Http\Requests\DressUser\SaveDressUserRequest;
use App\Models\DressUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DressUserController
{
    /**
     * @param SaveDressUserRequest $request
     * @return JsonResponse
     */
    public function save(SaveDressUserRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        $dress_user = DressUser::create([
            'dress_id' => $requestData['dress_id'],
            'user_id' => $requestData['user_id'],
        ]);

        if ($dress_user)
            return response()->json(['date' => $dress_user->toArray()], Response::HTTP_OK);
        else
            return response()->json(['error' => 'dress_user_save_error'], Response::HTTP_BAD_GATEWAY);
    }
}
