<?php

namespace App\Http\Module\Order\Resource;

use App\Http\Module\Item\Resource\ItemResource;
use App\Http\Module\User\Resource\UserResource;
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
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at
        ];
    }
}
