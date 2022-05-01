<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Item::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $items = Item::with('images', 'itemFeedbacks')->get();
        return response()->json(['items' => new ItemCollection($items)]);
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
        $this->setValues($request, new Item())->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return JsonResponse
     */
    public function show(Item $item)
    {
        $item->load('images', 'itemFeedbacks');
        return response()->json(['item' => new ItemResource($item)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, Item $item)
    {
        $this->setValues($request, $item)->saveOrFail();
        return response()->json(status: 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Item $item)
    {
        $item->deleteOrFail();
        return response()->json(status: 204);
    }

    private function setValues(Request $request, Item $item): Item
    {
        $this->validate($request);
        $item->name = $request->name;
        $item->details = $request->details;
        $item->type = $request->type;
        $item->base_price = $request->base_price;
        $item->sale = $request->sale;
        $item->average_rating = $request->average_rating;
        $item->menu_id = $request->menu_id;
        $item->is_trending = $request->is_trending;
        return $item;
    }
    private function validate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'details' => 'required|string',
            'type' => 'required|in:plate,sandwich,dessert,drink|string',
            'base_price' => 'required|numeric',
            'sale' => 'required|min:0|max:100|integer',
            'menu_id' => 'required|integer|exists:menus,id',
            'is_trending' => 'required|boolean'
        ]);
    }
}
