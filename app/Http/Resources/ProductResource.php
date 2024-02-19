<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $has_offer
 * @property mixed $discount
 * @property mixed $price
 * @property mixed $description
 * @property mixed $name
 */
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
//            'tags' => (array)array_values($this->meta),
            'has_offer' => $this->has_offer,
            'in_stock' => true,
            'attributes' => ProductAttributeResource::collection($this->whenLoaded('attributes')),
            'addons' => ProductAddonResource::collection($this->whenLoaded('addons')),
            'store' => new StoreResource($this->whenLoaded('store')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'branches' => BranchResource::collection($this->whenLoaded('branches')),
            'media' => MediaResource::collection($this->whenLoaded('media')),
            'colors' => ColorResource::collection($this->whenLoaded('colors')),
            'sizes' => SizeResource::collection($this->whenLoaded('sizes')),
        ];
    }
}
