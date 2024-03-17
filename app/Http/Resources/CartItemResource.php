<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => new ProductResource($this->product),
            'quantity' => $this->quantity,
            'size' => $this->size ? new SizeResource($this->size) : null,
            'color' => $this->color ? new ColorResource($this->color) : null,
            'attribute_value' => $this->attributeValue ? new ProductAttributeResource($this->attributeValue) : null,
            'addons' => $this->addons->map(fn($addon) => new ProductAddonResource($addon->addon)),
            'item_price' => $this->item_price,
            'total_price' => $this->total_price,
        ];
    }
}
