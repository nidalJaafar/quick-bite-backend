<?php

namespace App\Http\Mappers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;

class ItemMapper
{
    public function itemRequestToItem(ItemRequest $request): Item
    {
        $item = new Item();
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
}
