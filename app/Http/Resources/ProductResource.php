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
            'meta' => $this->meta,
            'has_offer' => $this->has_offer,
            'store' => new StoreResource($this->whenLoaded('store')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'branches' => BranchResource::collection($this->whenLoaded('branches')),
            'media' => MediaResource::collection($this->whenLoaded('media')),
        ];
    }
}
