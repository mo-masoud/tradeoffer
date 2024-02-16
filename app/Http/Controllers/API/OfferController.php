<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferCollection;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $offers = Offer::with('media', 'store')
            ->when(
                $request->input('category'),
                fn($query) => $query->filterByCategory($request->input('category'))
            )
            ->when(
                $request->input('store'),
                fn($query) => $query->where('store_id', $request->input('store'))
            )
            ->active()
            ->when($request->input('featured') == 1, fn($query) => $query->featured())
            ->latest()
            ->paginate(request('per_page', 15))
            ->withQueryString();

        return api_response(
            new OfferCollection($offers)
        );
    }

    public function show(Offer $offer)
    {
        return api_response(
            new OfferResource($offer->load(['products' => [
                'media', 'categories'
            ], 'store', 'media']))
        );
    }
}
