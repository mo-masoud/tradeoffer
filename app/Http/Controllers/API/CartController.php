<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
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

    public function changeItemQuantity(Cart $cart, Product $product): JsonResponse
    {
        $item = $cart->items()->where('product_id', $product->id)->firstOrFail();

        $method = request('method');

        if ($item->quantity === 1 && $method === 'minus') {
            $item->delete();
        } else {
            $quantity = $method === 'minus' ? $item->quantity - 1 : $item->quantity + 1;
            $item->update([
                'quantity' => $quantity,
                'total_price' => $item->product->price * $quantity,
            ]);
        }

        $cart->update([
            'total_price' => $cart->items->sum('total_price'),
        ]);

        return api_response(new CartResource($cart->load(Cart::$defaultRelations)));
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
