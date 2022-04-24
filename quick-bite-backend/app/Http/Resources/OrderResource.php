<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => $this->resource->status,
            'user' => new UserResource($this->resource->user),
            'item' => new ItemResource($this->resource->item),
            'createdAt' => $this->resource->created_at,
            'updatedAt' => $this->resource->updated_at
        ];
    }
}
