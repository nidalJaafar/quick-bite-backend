<?php

namespace App\Http\Mappers;

use App\Http\Requests\ItemFeedbackRequest;
use App\Models\ItemFeedback;

class ItemFeedbackMapper
{
    public function itemFeedbackRequestToItemFeedback(ItemFeedbackRequest $request): ItemFeedback
    {
        $itemFeedback = new ItemFeedback();
        $itemFeedback->user_id = auth()->user()->id;
        $itemFeedback->rating = $request->rating;
        $itemFeedback->details = $request->details;
        $itemFeedback->item_id = $request->item_id;
        return $itemFeedback;
    }
}
