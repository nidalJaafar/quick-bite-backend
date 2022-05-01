<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $orders = Order::with('item.images', 'user')->get();
        return response()->json(['orders' => new OrderCollection($orders)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $this->setValues($request, new Order())->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function show(Order $order)
    {
        $order->load('item.images', 'user');
        return response()->json(['order' => new OrderResource($order)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, Order $order)
    {
        $this->setValues($request, $order)->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Order $order)
    {
        $order->deleteOrFail();
        return response()->json(status: 204);
    }

    private function setValues(Request $request, Order $order): Order
    {
        $this->validate($request);
        $order->status = $request->status;
        $order->item_id = $request->item_id;
        $order->user_id = auth()->user()->id;
        return $order;
    }

    private function validate(Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:pending,delivered',
            'item_id' => 'required|exists:items,id|integer'
        ]);
    }
}
