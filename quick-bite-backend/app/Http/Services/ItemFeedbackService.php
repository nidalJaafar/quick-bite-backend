<?php

namespace App\Http\Services;

use App\Http\Mappers\ItemFeedbackMapper;
use App\Http\Requests\ItemFeedbackRequest;
use App\Http\Resources\ItemFeedbackCollection;
use App\Http\Resources\ItemFeedbackResource;
use App\Models\ItemFeedback;
use App\Models\Order;
use Illuminate\Auth\Access\AuthorizationException;
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
    }

    /**
     * @throws Throwable
     */
    public function updateItemFeedback(ItemFeedbackRequest $request, ItemFeedback $itemFeedback){
        $itemFeedback->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteItemFeedback(ItemFeedback $itemFeedback) {
        $itemFeedback->deleteOrFail();
    }

}
