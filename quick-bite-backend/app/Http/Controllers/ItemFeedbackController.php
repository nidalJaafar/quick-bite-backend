<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemFeedbackCollection;
use App\Http\Resources\ItemFeedbackResource;
use App\Models\ItemFeedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $itemFeedbacks = ItemFeedback::with('user', 'item.images')->get();
        return response()->json(['item_feedbacks' => new ItemFeedbackCollection($itemFeedbacks)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->setValues($request, new ItemFeedback())->save();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $itemFeedback = ItemFeedback::with('user', 'item.images')->findOrFail($id);
        return response()->json(['item_feedback' => new ItemFeedbackResource($itemFeedback)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $this->setValues($request, ItemFeedback::findOrFail($id))->save();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        ItemFeedback::findOrFail($id)->destroy($id);
        return response()->json(status: 204);
    }

    private function setValues(Request $request, ItemFeedback $itemFeedback): ItemFeedback
    {
        $itemFeedback->user_id = $request->user_id;
        $itemFeedback->rating = $request->rating;
        $itemFeedback->details = $request->details;
        $itemFeedback->item_id = $request->item_id;
        return $itemFeedback;
    }
}
