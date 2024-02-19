<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('media', 'categories', 'colors', 'sizes', 'store', 'attributes', 'attributes.attribute', 'addons')
            ->when(
                $request->input('top_selling') == 1,
                fn($query) => $query->topSelling()
            )
            ->when(
                $request->input('category'),
                fn($query) => $query->filterByCategory($request->input('category'))
            )
            ->when(
                $request->input('store'),
                fn($query) => $query->where('store_id', $request->input('store'))
            )
            ->when(
                $request->input('branch'),
                fn($query) => $query->whereHas('branches', fn($query) => $query->where('id', $request->input('branch')))
            )
            ->when(
                $request->input('search'),
                fn($query) => $query->search($request->input('search'))
            )
            ->when(
                $request->input('min_price') && $request->input('max_price'),
                fn($query) => $query->filterByPrice($request->input('min_price'), $request->input('max_price'))
            )
            ->when(
                $request->input('order_by_price'),
                fn($query) => $query->orderByPrice($request->input('order_by_price'))
            )
            ->latest()
            ->paginate(request('per_page', 15))
            ->withQueryString();

        return api_response(
            new ProductCollection($products)
        );
    }
}
