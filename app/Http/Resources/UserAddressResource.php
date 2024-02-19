<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @property mixed $is_primary
 * @property Point $location
 * @property mixed $details
 * @property mixed $address
 * @property mixed $phone
 * @property mixed $label
 * @property mixed $id
 */
class UserAddressResource extends JsonResource
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
            'label' => $this->label,
            'phone' => $this->phone,
            'address' => $this->address,
            'details' => $this->details,
            'latitude' => $this->location?->latitude,
            'longitude' => $this->location?->longitude,
            'is_primary' => $this->is_primary,
        ];
    }
}
