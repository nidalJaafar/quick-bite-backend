<?php

namespace App\Http\Module\ItemFeedback\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\ItemFeedback\Request\ItemFeedbackRequest;
use App\Http\Module\ItemFeedback\Service\ItemFeedbackService;
use App\Models\ItemFeedback;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

class ItemFeedbackController extends Controller
{
    private ItemFeedbackService $service;

    public function __construct(ItemFeedbackService $service)
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
        return response()->json(['item_feedbacks' => $this->service->getItemFeedbacks()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ItemFeedbackRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(ItemFeedbackRequest $request): JsonResponse
    {
        $this->authorize('create', ItemFeedback::class);
        $this->service->createItemFeedback($request);
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ItemFeedback $itemFeedback
     * @return JsonResponse
     */
    public function show(ItemFeedback $itemFeedback): JsonResponse
    {
        return response()->json(['item_feedback' => $this->service->getItemFeedback($itemFeedback)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ItemFeedbackRequest $request
     * @param ItemFeedback $itemFeedback
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(ItemFeedbackRequest $request, ItemFeedback $itemFeedback): JsonResponse
    {
        $this->authorize('update', $itemFeedback);
        $this->service->updateItemFeedback($request, $itemFeedback);
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ItemFeedback $itemFeedback
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(ItemFeedback $itemFeedback): JsonResponse
    {
        $this->authorize('delete', $itemFeedback);
        $this->service->deleteItemFeedback($itemFeedback);
        return response()->json(status: 204);
    }

}
