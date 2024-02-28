<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @property mixed $cover_image
 * @property mixed $image
 * @property mixed $rating
 * @property mixed $description
 * @property mixed $name
 * @property mixed $id
 */
class StoreResource extends JsonResource
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
            'rating' => (double)$this->rating,
            'image' => asset(Storage::url($this->image)),
            'cover_image' => asset(Storage::url($this->cover_image)),
            'branches' => BranchResource::collection($this->whenLoaded('branches')),
        ];
    }
}
