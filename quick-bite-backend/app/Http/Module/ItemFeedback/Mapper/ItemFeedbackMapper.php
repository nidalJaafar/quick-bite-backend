<?php

namespace App\Http\Module\ItemFeedback\Mapper;

use App\Http\Module\ItemFeedback\Request\ItemFeedbackRequest;
use App\Models\ItemFeedback;
use function auth;

class ItemFeedbackMapper
{
    public function itemFeedbackRequestToItemFeedback(ItemFeedbackRequest $request): ItemFeedback
    {
        $itemFeedback = new ItemFeedback($request->all());
        $itemFeedback->user_id = auth()->user()->id;
        return $itemFeedback;
    }
}
