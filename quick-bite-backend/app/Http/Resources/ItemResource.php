<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'details' => $this->resource->details,
            'type' => $this->resource->type,
            'basePrice' => $this->resource->base_price,
            'sale' => $this->resource->sale,
            'averageRating' => $this->resource->average_rating,
            'isTrending' => $this->resource->is_trending,
            'images' => new ImageCollection($this->resource->images),
        ];
    }
}
