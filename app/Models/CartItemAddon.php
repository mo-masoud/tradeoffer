<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItemAddon extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_item_id',
        'product_addon_id',
        'quantity',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(CartItem::class);
    }

    public function addon(): BelongsTo
    {
        return $this->belongsTo(ProductAddon::class, 'product_addon_id');
    }
}
