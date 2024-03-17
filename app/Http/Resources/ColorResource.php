<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
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
            'color' => $this->color,
            'extra_price' => $this->whenPivotLoaded('color_product', fn() => (double)$this->pivot->extra_price),
            'in_stock' => $this->whenPivotLoaded('color_product', fn() => (bool)$this->pivot->in_stock),
        ];
    }
}
