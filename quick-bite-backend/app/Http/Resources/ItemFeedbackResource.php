<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemFeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'rating' => $this->resource->rating,
            'details' => $this->resource->details,
            'item' => new ItemResource($this->resource->item),
            'user' => new UserResource($this->whenLoaded('user')),
            'createdAt' => $this->resource->created_at,
            'updatedAt' => $this->resource->updated_at
        ];
    }
}
