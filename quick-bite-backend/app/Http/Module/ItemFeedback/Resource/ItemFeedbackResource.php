<?php

namespace App\Http\Module\ItemFeedback\Resource;

use App\Http\Module\Item\Resource\ItemResource;
use App\Http\Module\User\Resource\UserResource;
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
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at
        ];
    }
}
