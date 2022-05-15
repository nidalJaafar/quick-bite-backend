<?php

namespace App\Http\Module\ItemFeedback\Service;

use App\Http\Module\ItemFeedback\Mapper\ItemFeedbackMapper;
use App\Http\Module\ItemFeedback\Request\ItemFeedbackRequest;
use App\Http\Module\ItemFeedback\Resource\ItemFeedbackCollection;
use App\Http\Module\ItemFeedback\Resource\ItemFeedbackResource;
use App\Models\Item;
use App\Models\ItemFeedback;
use App\Models\Order;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Throwable;

class ItemFeedbackService
{
    private ItemFeedbackMapper $mapper;

    /**
     * @param ItemFeedbackMapper $mapper
     */
    public function __construct(ItemFeedbackMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getItemFeedbacks(): ItemFeedbackCollection
    {
        $itemFeedbacks = ItemFeedback::with('user', 'item.images')->get();
        return new ItemFeedbackCollection($itemFeedbacks);
    }

    public function getItemFeedback(ItemFeedback $itemFeedback): ItemFeedbackResource
    {
        $itemFeedback->load('user', 'item.images');
        return new ItemFeedbackResource($itemFeedback);
    }

    /**
     * @throws Throwable
     * @throws AuthorizationException
     */
    public function createItemFeedback(ItemFeedbackRequest $request)
    {
        $itemFeedback = $this->mapper->itemFeedbackRequestToItemFeedback($request);
        $order = Order::where('item_id', $itemFeedback->item_id)
            ->where('user_id', $itemFeedback->user_id)
            ->where('status', 'delivered')->first();
        if (!isset($order)) throw new AuthorizationException();
        $itemFeedback->saveOrFail();
        $this->updateAverageRating($request);
    }

    /**
     * @throws Throwable
     */
    public function updateItemFeedback(ItemFeedbackRequest $request, ItemFeedback $itemFeedback)
    {
        $itemFeedback->updateOrFail($request->all());
        $this->updateAverageRating($request);
    }

    /**
     * @throws Throwable
     */
    public function deleteItemFeedback(ItemFeedback $itemFeedback)
    {
        $itemFeedback->deleteOrFail();
    }

    private function updateAverageRating(ItemFeedbackRequest $request)
    {
        $average = ItemFeedback::query()->groupBy('item_id')->having('item_id', $request->item_id)->average('rating');
        Item::find($request->item_id)->update(['average_rating' => $average]);
    }

}
