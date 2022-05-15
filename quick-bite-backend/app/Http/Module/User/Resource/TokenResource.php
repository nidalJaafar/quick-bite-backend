<?php

namespace App\Http\Module\User\Resource;

use App\Http\Module\User\Resource\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
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
            'token' => $this->resource->token,
            'user' => new UserResource($this->resource->user)
        ];
    }
}
