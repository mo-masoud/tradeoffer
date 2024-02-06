<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('children')->active()->whereNull('parent_id')->orderBy('order')->get();

        return inertia('home/index', compact('categories'));
    }
}
