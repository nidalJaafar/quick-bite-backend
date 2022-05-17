<?php

namespace App\Http\Module\Item\Service;

use App\Http\Module\Item\Mapper\ItemMapper;
use App\Http\Module\Item\Request\ItemRequest;
use App\Http\Module\Item\Resource\ItemCollection;
use App\Http\Module\Item\Resource\ItemResource;
use App\Models\Item;
use Throwable;

class ItemService
{
    private ItemMapper $mapper;

    /**
     * @param ItemMapper $mapper
     */
    public function __construct(ItemMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getItems(): ItemCollection
    {
        $items = Item::with('images', 'itemFeedbacks')->get();
        return new ItemCollection($items);
    }

    public function getItem(Item $item): ItemResource
    {
        $item->load('images', 'itemFeedbacks');
        return new ItemResource($item);
    }

    /**
     * @throws Throwable
     */
    public function createItem(ItemRequest $request)
    {
        $this->mapper->itemRequestToItem($request)->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function updateItem(ItemRequest $request, Item $item)
    {
        $item->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteOrFail(Item $item)
    {
        $item->deleteOrFail();
    }

    public function getTrendingItems(): ItemCollection
    {
        $items = Item::with('images', 'itemFeedbacks')->where('is_trending', 1)->get();
        return new ItemCollection($items);
    }

}
