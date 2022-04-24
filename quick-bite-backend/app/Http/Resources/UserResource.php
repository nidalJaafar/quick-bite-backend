<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'firstName' => $this->resource->first_name,
            'lastName' => $this->resource->last_name,
            'email' => $this->resource->email,
            'password' => $this->resource->password,
            'role' => $this->resource->role,
            'itemFeedbacks' => new ItemFeedbackCollection($this->whenLoaded('itemFeedbacks')),
            'visitFeedback' => new VisitFeedbackResource($this->whenLoaded('visitFeedback')),
            'createdAt' => $this->resource->created_at,
            'updatedAt' => $this->resource->updated_at
        ];
    }
}
