<?php

namespace App\Http\Mappers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;

class OrderMapper
{
    public function orderRequestToOrder(OrderRequest $request): Order
    {
        $order = new Order();
        $order->status = $request->status;
        $order->item_id = $request->item_id;
        $order->user_id = auth()->user()->id;
        return $order;
    }
}
