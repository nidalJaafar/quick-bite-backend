<?php

namespace App\Http\Module\User\Resource;

use App\Http\Module\ItemFeedback\Resource\ItemFeedbackCollection;
use App\Http\Module\VisitFeedback\Resource\VisitFeedbackResource;
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
            'first_name' => $this->resource->first_name,
            'last_name' => $this->resource->last_name,
            'email' => $this->resource->email,
            'role' => $this->resource->role,
            'item_feedbacks' => new ItemFeedbackCollection($this->whenLoaded('itemFeedbacks')),
            'visit_feedback' => new VisitFeedbackResource($this->whenLoaded('visitFeedback')),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at
        ];
    }
}
