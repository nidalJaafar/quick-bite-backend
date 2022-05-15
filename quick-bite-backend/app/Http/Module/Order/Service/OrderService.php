<?php

namespace App\Http\Module\Order\Service;

use App\Http\Module\Order\Mapper\OrderMapper;
use App\Http\Module\Order\Request\OrderRequest;
use App\Http\Module\Order\Resource\OrderCollection;
use App\Http\Module\Order\Resource\OrderResource;
use App\Models\Order;
use App\Models\Reservation;
use Throwable;
use function auth;

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
        if ($order->status == 'pending') {
            Reservation::with('user_id', $order->user_id)
                ->with('status', 'pending')
                ->update(['status' => 'in restaurant']);
        }
        $order->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function updateOrder(OrderRequest $request, Order $order)
    {
        if ($request->status == 'delivered') {
            Reservation::with('user_id', $order->user_id)
                ->with('status', 'in restaurant')
                ->update(['status' => 'done']);
        }
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
