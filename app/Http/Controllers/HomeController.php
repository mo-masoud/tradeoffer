<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResource;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('children')->active()->whereNull('parent_id')->orderBy('order')->take(6)->get();
        $sliders = Slider::pluck('image')->toArray();
        $offers = Offer::with('media', 'branch.store')
            ->withCount('products')
            ->whereHas('products')
            ->active()
            ->take(4)
            ->get();
        $offers = OfferResource::collection($offers);

        return inertia('home/index', compact('categories', 'sliders', 'offers'));
    }
}
