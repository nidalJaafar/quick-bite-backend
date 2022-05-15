<?php

namespace App\Http\Module\Menu\Resource;

use App\Http\Module\Item\Resource\ItemCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'name' => $this->resource->name,
            'items' => new ItemCollection($this->resource->items)
        ];
    }
}
