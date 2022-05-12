<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'full_name' => $this->resource->full_name,
            'image' => $this->resource->image,
            'position' => $this->resource->position,
            'fb_link' => $this->whenNotNull($this->resource->fb_link),
            'twitter_link' => $this->whenNotNull($this->resource->twitter_link),
            'ig_link' => $this->whenNotNull($this->resource->ig_link)
        ];
    }
}
