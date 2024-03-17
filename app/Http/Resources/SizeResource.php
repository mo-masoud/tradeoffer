<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
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
            'size' => $this->size,
            'extra_price' => $this->whenPivotLoaded('product_size', fn() => (double)$this->pivot->extra_price),
            'in_stock' => $this->whenPivotLoaded('product_size', fn() => (bool)$this->pivot->in_stock),
        ];
    }
}
