<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orders = Order::with('item.images', 'user')->get();
        return response()->json(['orders' => new OrderCollection($orders)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->setValues($request, new Order())->save();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $order = Order::with('item.images', 'user')->findOrFail($id);
        return response()->json(['order' => new OrderResource($order)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $this->setValues($request, Order::findOrFail($id))->save();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Order::findOrFail($id)->destroy($id);
        return response()->json(status: 204);
    }

    private function setValues(Request $request, Order $order): Order
    {
        $order->status = $request->status;
        $order->item_id = $request->item_id;
        $order->user_id = $request->user_id;
        return $order;
    }
}
