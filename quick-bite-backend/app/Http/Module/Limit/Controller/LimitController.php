<?php

namespace App\Http\Module\Limit\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\Limit\Request\LimitRequest;
use App\Http\Module\Limit\Service\LimitService;
use App\Models\Limit;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Throwable;

class LimitController extends Controller
{

    private LimitService $service;

    /**
     * @param LimitService $service
     */
    public function __construct(LimitService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['limit' => $this->service->getLimit()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LimitRequest $request
     * @return JsonResponse
     * @throws AuthorizationException|Throwable
     */
    public function store(LimitRequest $request): JsonResponse
    {
        $this->authorize('create', Limit::class);
        $this->service->updateLimit($request);
        return response()->json(status: 201);
    }

}
