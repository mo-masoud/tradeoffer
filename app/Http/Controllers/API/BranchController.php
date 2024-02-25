<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchCollection;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branch::with([
            'store'
        ])
            ->when($request->has('store'), function ($query) use ($request) {
                $query->where('store_id', $request->input('store'));
            })
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('name_en', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('name_ar', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('address_en', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('address_ar', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('phone', 'like', '%' . $request->input('search') . '%')
                        ->orWhereHas('store', function ($query) use ($request) {
                            $query->where('name_en', 'like', '%' . $request->input('search') . '%')
                                ->orWhere('name_ar', 'like', '%' . $request->input('search') . '%')
                                ->orWhere('description_en', 'like', '%' . $request->input('search') . '%')
                                ->orWhere('description_ar', 'like', '%' . $request->input('search') . '%');
                        })
                        ->orWhereHas('products', function ($query) use ($request) {
                            $query->where('name_en', 'like', '%' . $request->input('search') . '%')
                                ->orWhere('name_ar', 'like', '%' . $request->input('search') . '%')
                                ->orWhere('description_en', 'like', '%' . $request->input('search') . '%')
                                ->orWhere('description_ar', 'like', '%' . $request->input('search') . '%');
                        })
                        ->orWhereHas('products.categories', function ($query) use ($request) {
                            $query->where('name_en', 'like', '%' . $request->input('search') . '%')
                                ->orWhere('name_ar', 'like', '%' . $request->input('search') . '%');
                        })
                        ->orWhereHas('store.categories', function ($query) use ($request) {
                            $query->where('name_en', 'like', '%' . $request->input('search') . '%')
                                ->orWhere('name_ar', 'like', '%' . $request->input('search') . '%');
                        });
                });
            })
            ->when($request->has('category'), function ($query) use ($request) {
                $query->whereHas('products.categories', function ($query) use ($request) {
                    $query->where('id', $request->input('category'));
                })->orWhereHas('store.categories', function ($query) use ($request) {
                    $query->where('id', $request->input('category'));
                });
            })
            ->when($request->has('order_by_nearest'), function ($query) use ($request) {
                $query->orderByDistanceWithinCoveredZone($request->input('order_by_nearest'));
            })
            ->latest()
            ->paginate(request('per_page', 15))
            ->withQueryString();

        return api_response(new BranchCollection($branches));
    }
}
