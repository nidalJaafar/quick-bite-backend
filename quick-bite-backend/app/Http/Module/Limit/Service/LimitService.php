<?php

namespace App\Http\Module\Limit\Service;

use App\Http\Module\Limit\Request\LimitRequest;
use App\Http\Module\Limit\Resource\LimitResource;
use App\Models\Limit;
use Throwable;

class LimitService
{
    public function getLimit(): LimitResource
    {
        return new LimitResource(Limit::all()->first());
    }

    /**
     * @throws Throwable
     */
    public function updateLimit(LimitRequest $request)
    {
        Limit::all()->first()->updateOrFail($request->all());
    }
}
