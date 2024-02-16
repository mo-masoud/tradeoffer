<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::forHome()
            ->paginate(request('per_page', 15))
            ->withQueryString();

        return api_response(
            new CategoryCollection($categories)
        );
    }
}
