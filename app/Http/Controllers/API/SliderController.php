<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        return api_response([
            'data' => Slider::pluck('image')
                ->map(fn($slider) => asset('storage/' . $slider)),
        ]);
    }
}
