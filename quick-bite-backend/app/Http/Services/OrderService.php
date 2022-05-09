<?php

namespace App\Http\Services;

use App\Http\Mappers\OrderMapper;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Throwable;

class OrderService
{
    private OrderMapper $mapper;

    /**
     * @param OrderMapper $mapper
     */
    public function __construct(OrderMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getOrders(): OrderCollection
    {
        $orders = Order::with('item.images', 'user')->get();
        return new OrderCollection($orders);
    }

    public function getOrder(Order $order): OrderResource
    {
        $order->load('item.images', 'user');
        return new OrderResource($order);
    }

    /**
     * @throws Throwable
     */
    public function createOrder(OrderRequest $request)
    {
        $order = $this->mapper->orderRequestToOrder($request);
        $order->user_id = auth()->user()->id;
        $order->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function updateOrder(OrderRequest $request, Order $order)
    {
        $order->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteOrder(Order $order)
    {
        $order->deleteOrFail();
    }

}
