<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreCollection;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $stores = Store::when(
            $request->input('category'),
            fn($query) => $query->filterByCategory($request->input('category'))
        )->when($request->input('featured') == 1, fn($query) => $query->featured())
            ->active()
            ->latest()
            ->paginate(request('per_page', 15))
            ->withQueryString();

        return api_response(
            new StoreCollection($stores)
        );
    }

    public function show(Store $store)
    {
        return api_response(
            new StoreResource($store->load([
                'branches'
            ]))
        );
    }
}
