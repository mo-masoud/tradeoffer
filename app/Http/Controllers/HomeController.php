<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = CategoryResource::collection(
            Category::with('children')->active()->whereNull('parent_id')->orderBy('order')->take(6)->get()
        );
        $sliders = Slider::pluck('image')->toArray();
        $offers = OfferResource::collection(
            Offer::with('media', 'branch.store')
                ->withCount('products')
                ->whereHas('products')
                ->active()
                ->take(4)
                ->get()
        );
        $mostSoldProducts = ProductResource::collection(
            Product::with('media', 'category')->mostSelling()->take(8)->get()
        );

        $latestArrivals = ProductResource::collection(
            Product::with('media', 'category')->latest()->take(8)->get()
        );

        return inertia('home/index', compact('categories', 'sliders', 'offers', 'mostSoldProducts', 'latestArrivals'));
    }
}
