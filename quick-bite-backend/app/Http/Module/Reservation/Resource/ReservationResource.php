<?php

namespace App\Http\Module\Reservation\Resource;

use App\Http\Module\User\Resource\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'number_of_people' => $this->resource->number_of_people,
            'date' => $this->resource->date,
            'user' => new UserResource($this->resource->user),
            'status' => $this->resource->status,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at
        ];
    }
}
