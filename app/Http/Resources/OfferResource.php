<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'discount' => $this->discount,
            'max_discount' => $this->max_discount,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'products_count' => $this->products_count,
            'media' => MediaResource::collection($this->whenLoaded('media')),
            'branch' => new BranchResource($this->whenLoaded('branch')),
        ];
    }
}
