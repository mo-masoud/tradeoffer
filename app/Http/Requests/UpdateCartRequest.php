<?php

namespace App\Http\Requests;

use Illuminate\Support\Collection;

class UpdateCartRequest extends StoreCartRequest
{
    protected function saveCart(Collection $cartItems)
    {
        $this->cart->update([
            'user_id' => auth()->id() ?? $this->cart->user_id,
            'total_price' => $cartItems->sum('total_price')
        ]);

        return $this->cart->refresh();
    }
}
