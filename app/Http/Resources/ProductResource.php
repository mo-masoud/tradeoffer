<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'in_stock' => $this->in_stock,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'branch' => new BranchResource($this->whenLoaded('branch')),
            'media' => MediaResource::collection($this->whenLoaded('media')),
        ];
    }
}
