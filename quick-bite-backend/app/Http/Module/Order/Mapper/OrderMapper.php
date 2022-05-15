<?php

namespace App\Http\Module\Order\Mapper;

use App\Http\Module\Order\Request\OrderRequest;
use App\Models\Order;
use function auth;

class OrderMapper
{
    public function orderRequestToOrder(OrderRequest $request): Order
    {
        $order = new Order($request->all());
        $order->user_id = auth()->user()->id;
        return $order;
    }
}
