<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemFeedbackCollection;
use App\Http\Resources\ItemFeedbackResource;
use App\Models\ItemFeedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ItemFeedbackController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ItemFeedback::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $itemFeedbacks = ItemFeedback::with('user', 'item.images')->get();
        return response()->json(['item_feedbacks' => new ItemFeedbackCollection($itemFeedbacks)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $itemFeedback = new ItemFeedback();
        $this->setValues($request, $itemFeedback);
//        dd(array_map(fn($i) => $i['item_id'], $itemFeedback->user->orders->toArray()));
//        dd();
//        $this->authorize('createFeedback', [$itemFeedback->user, $itemFeedback->item]);
        $itemFeedback->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ItemFeedback $itemFeedback
     * @return JsonResponse
     */
    public function show(ItemFeedback $itemFeedback)
    {
        $itemFeedback->load('user', 'item.images');
        return response()->json(['item_feedback' => new ItemFeedbackResource($itemFeedback)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ItemFeedback $itemFeedback
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, ItemFeedback $itemFeedback)
    {
        $this->setValues($request, $itemFeedback)->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ItemFeedback $itemFeedback
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(ItemFeedback $itemFeedback)
    {
        $itemFeedback->deleteOrFail();
        return response()->json(status: 204);
    }
    private function setValues(Request $request, ItemFeedback $itemFeedback): ItemFeedback
    {
        $this->validate($request);
        $itemFeedback->user_id = $request->user_id;
        $itemFeedback->rating = $request->rating;
        $itemFeedback->details = $request->details;
        $itemFeedback->item_id = $request->item_id;
        return $itemFeedback;
    }
    private function validate(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:0|max:5',
            'details' => 'required|string',
            'item_id' => 'required|exists:items,id|integer',
            'user_id' => 'required|exists:users,id|integer',
        ]);
    }
}
