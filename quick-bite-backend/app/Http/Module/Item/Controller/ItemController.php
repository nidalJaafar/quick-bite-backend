<?php

namespace App\Http\Module\Item\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\Item\Request\ItemRequest;
use App\Http\Module\Item\Service\ItemService;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

class ItemController extends Controller
{
    private ItemService $service;

    public function __construct(ItemService $service)
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
        return response()->json(['items' => $this->service->getItems()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ItemRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(ItemRequest $request): JsonResponse
    {
        $this->authorize('create', Item::class);
        $this->service->createItem($request);
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return JsonResponse
     */
    public function show(Item $item): JsonResponse
    {
        return response()->json(['item' => $this->service->getItem($item)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ItemRequest $request
     * @param Item $item
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(ItemRequest $request, Item $item): JsonResponse
    {
        $this->authorize('update', $item);
        $this->service->updateItem($request, $item);
        return response()->json(status: 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Item $item): JsonResponse
    {
        $this->authorize('delete', $item);
        $this->service->deleteOrFail($item);
        return response()->json(status: 204);
    }
}
