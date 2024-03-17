<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\CartProductValidator;
use App\Models\Cart;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class StoreCartRequest extends FormRequest
{
    use CartProductValidator;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'products' => 'required|array',
            'products.*.id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.size_id' => 'nullable|integer|exists:sizes,id',
            'products.*.color_id' => 'nullable|integer|exists:colors,id',
            'products.*.attribute_id' => 'nullable|integer|exists:attributes,id',
            'products.*.addons' => 'nullable|array',
            'products.*.addons.*.id' => 'required|integer|exists:product_addons,id',
            'products.*.addons.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function cartItems(Collection $products): Collection
    {
        $items = collect([]);

        foreach ($products as $index => $product) {
            $size = $product->sizes->where('id', $this->input('products.*.size_id')[$index])->first();
            $color = $product->colors->where('id', $this->input('products.*.color_id')[$index])->first();
            $attribute = $product->attributes->where('id', $this->input('products.*.attribute_id')[$index])->first();

            $totalPrice = $product->price;

            $addons = collect([]);
            if ($this->input('products.*.addons')[$index]) {
                foreach ($this->input('products.*.addons')[$index] as $addon) {
                    $addonItem = $product->addons->where('id', $addon['id'])->first();
                    $addons->push($addonItem);

                    $totalPrice += $addon['quantity'] * $addonItem->price;
                }
            }

            $totalPrice += $size->pivot['extra_price'] ?? 0;
            $totalPrice += $color->pivot['extra_price'] ?? 0;
            $totalPrice += $attribute->pivot['extra_price'] ?? 0;

            // calculate the total price after adding the addons

            $totalPrice = $totalPrice * $this->input('products.*.quantity')[$index];

            $items->push([
                'product' => $product,
                'quantity' => $this->input('products.*.quantity')[$index],
                'size_id' => $this->input('products.*.size_id')[$index],
                'color_id' => $this->input('products.*.color_id')[$index],
                'attribute_id' => $this->input('products.*.attribute_id')[$index],
                'addons' => $this->input('products.*.addons')[$index] ?? [],
                'item_price' => $product->price,
                'total_price' => $totalPrice,
            ]);
        }

        return $items;
    }

    public function save(Collection $cartItems)
    {
        $cart = $this->saveCart($cartItems);

        $cart->items()->delete();
        $cartItems->each(function ($item) use ($cart) {
            $cartItem = $cart->items()->create([
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'size_id' => $item['size_id'],
                'color_id' => $item['color_id'],
                'attribute_value_id' => $item['attribute_id'],
                'item_price' => $item['item_price'],
                'total_price' => $item['total_price']
            ]);

            if ($item['addons']) {
                foreach ($item['addons'] as $addon) {
                    $cartItem->addons()->create([
                        'product_addon_id' => $addon['id'],
                        'quantity' => $addon['quantity']
                    ]);
                }
            }
        });

        return $cart->load(Cart::$defaultRelations);
    }

    protected function saveCart(Collection $cartItems)
    {
        return Cart::create([
            'user_id' => auth()->id(),
            'total_price' => $cartItems->sum('total_price')
        ]);
    }

    /**
     * @return string
     */
    protected function orderedIds(): string
    {
        return implode(',', $this->input('products.*.id'));
    }
}
