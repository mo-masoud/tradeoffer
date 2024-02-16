<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StoreResource;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $slider = Slider::pluck('image')->map(fn($slider) => asset('storage/' . $slider));
        $categories = Category::forHome()->get();
        $offers = Offer::top()->take(8)->get();
        $topSellingProducts = Product::with('store', 'categories', 'media')->topSelling()->take(12)->get();
        $stores = Store::active()->featured()->take(4)->get();
        $latestProducts = Product::with('store', 'categories', 'media')->latest()->take(18)->get();

        return inertia('home/index', [
            'slider' => $slider,
            'categories' => CategoryResource::collection($categories),
            'topSellingProducts' => ProductResource::collection($topSellingProducts),
            'offers' => OfferResource::collection($offers),
            'stores' => StoreResource::collection($stores),
            'latestProducts' => ProductResource::collection($latestProducts),
        ]);
    }
}
