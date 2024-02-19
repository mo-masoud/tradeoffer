<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request): JsonResponse
    {
        return api_response(
            new UserResource($request->user())
        );
    }

    public function update(UpdateProfileRequest $request): JsonResponse
    {

        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $request->user()->update($data);

        return api_response(
            new UserResource($request->user())
        );
    }
}
