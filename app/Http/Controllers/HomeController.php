<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('children')->active()->whereNull('parent_id')->orderBy('order')->get();
        $sliders = Slider::pluck('image')->toArray();

        return inertia('home/index', compact('categories', 'sliders'));
    }
}
