<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Http\Resources\UserAddressResource;
use App\Models\UserAddress;
use Illuminate\Http\JsonResponse;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $addresses = auth()->user()->addresses;

        return api_response(
            UserAddressResource::collection($addresses)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAddressRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['location'] = [
            'type' => 'Point',
            'coordinates' => [
                $data['longitude'],
                $data['latitude'],
            ],
        ];
        $address = auth()->user()->addresses()->create($data);

        return api_response(
            new UserAddressResource($address),
            201
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress): JsonResponse
    {
        $data = $request->validated();
        $data['location'] = [
            'type' => 'Point',
            'coordinates' => [
                $data['longitude'],
                $data['latitude'],
            ],
        ];

        $userAddress->update($data);

        if ($request->input('is_primary')) {
            $userAddress->user->addresses()->whereKeyNot($userAddress->id)->update([
                'is_primary' => false,
            ]);
        }

        return api_response(
            new UserAddressResource($userAddress)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $userAddress): JsonResponse
    {
        if ($userAddress->is_primary) {
            return api_response([
                'message' => 'You can not delete your primary address',
            ], 422);
        }

        $userAddress->delete();

        return api_response(null, 204);
    }
}
