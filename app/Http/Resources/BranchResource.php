<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'address' => $this->address,
            'latitude' => $this->location?->latitude,
            'longitude' => $this->location?->longitude,
            'covered_zone' => $this->covered_zone,
            'distance' => $this->when($request->has('order_by_nearest'), function () {
                return round($this->distance, 2);
            }),
            'phone' => $this->phone,
            'store' => new StoreResource($this->whenLoaded('store')),
        ];
    }
}
