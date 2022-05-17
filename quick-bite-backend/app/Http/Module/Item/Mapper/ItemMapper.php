<?php

namespace App\Http\Module\Item\Mapper;

use App\Http\Module\Item\Request\ItemRequest;
use App\Models\Item;

class ItemMapper
{
    public function itemRequestToItem(ItemRequest $request): Item
    {
        $item = new Item($request->except('images'));
        $item->average_rating = 0;
        return $item;
    }
}
