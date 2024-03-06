<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIndexRequest;
use App\Http\Resources\StoreCollection;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function index(StoreIndexRequest $request): JsonResponse
    {
        $stores = $request->buildQuery()
            ->paginate(request('per_page', 15))
            ->withQueryString();

        return api_response(
            new StoreCollection($stores)
        );
    }

    public function show(Store $store): JsonResponse
    {
        return api_response(
            new StoreResource($store->load([
                'categories.children',
                'branches'
            ]))
        );
    }
}
