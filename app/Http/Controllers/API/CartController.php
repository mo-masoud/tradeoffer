<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

use function Pest\Laravel\json;

class CartController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function store(StoreCartRequest $request): JsonResponse
    {
        $products = $request->validatedProducts();
        $cartItems = $request->cartItems($products);
        $cart = $request->save($cartItems);

        return api_response(new CartResource($cart));
    }

    /**
     * @throws ValidationException
     */
    public function update(UpdateCartRequest $request, Cart $cart): JsonResponse
    {
        $products = $request->validatedProducts();
        $cartItems = $request->cartItems($products);
        $cart = $request->save($cartItems);

        return api_response(new CartResource($cart));
    }

    protected function show(Cart $cart): JsonResponse
    {
        return api_response(new CartResource($cart->load(Cart::$defaultRelations)));
    }

    protected function destroy(Cart $cart): JsonResponse
    {
        $cart->delete();

        return api_response(null, 204);
    }
}
