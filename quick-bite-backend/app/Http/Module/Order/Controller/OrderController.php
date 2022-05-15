<?php

namespace App\Http\Module\Order\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\Order\Request\OrderRequest;
use App\Http\Module\Order\Service\OrderService;
use App\Models\Order;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

class OrderController extends Controller
{
    private OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Order::class);
        return response()->json(['orders' => $this->service->getOrders()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $this->authorize('create', Order::class);
        $this->service->createOrder($request);
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Order $order): JsonResponse
    {
        $this->authorize('view', $order);
        return response()->json(['order' => $this->service->getOrder($order)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param Order $order
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(OrderRequest $request, Order $order): JsonResponse
    {
        $this->authorize('update', $order);
        $this->service->updateOrder($request, $order);
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Order $order): JsonResponse
    {
        $this->authorize('delete', $order);
        $this->service->deleteOrder($order);
        return response()->json(status: 204);
    }

}
