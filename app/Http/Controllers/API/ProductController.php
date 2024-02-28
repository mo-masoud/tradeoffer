<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request): JsonResponse
    {
        $products = $request->buildQuery()
            ->paginate(request('per_page', 15))
            ->withQueryString();

        return api_response(
            new ProductCollection($products)
        );
    }
}
