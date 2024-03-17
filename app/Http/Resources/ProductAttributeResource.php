<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->attribute?->name,
            'value' => $this->value,
            'extra_price' => $this->whenPivotLoaded('attribute_value_product', fn() => (double)$this->pivot->extra_price),
            'in_stock' => $this->whenPivotLoaded('attribute_value_product', fn() => (bool)$this->pivot->in_stock)
        ];
    }
}
