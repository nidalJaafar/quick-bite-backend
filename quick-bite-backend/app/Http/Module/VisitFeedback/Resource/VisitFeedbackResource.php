<?php

namespace App\Http\Module\VisitFeedback\Resource;

use App\Http\Module\User\Resource\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitFeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'rating' => $this->resource->rating,
            'details' => $this->resource->details,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at
        ];
    }
}
