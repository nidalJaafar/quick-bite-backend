<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemFeedbackCollection;
use App\Http\Resources\ItemFeedbackResource;
use App\Models\ItemFeedback;
use App\Models\Order;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $itemFeedback = $this->setValues($request, new ItemFeedback());
        $order = Order::where('item_id', $itemFeedback->item_id)
            ->where('user_id', $itemFeedback->user_id)
            ->where('status', 'delivered')->first();
        if (!isset($order)) throw new AuthorizationException();
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
        $itemFeedback->user_id = auth()->user()->id;
        $itemFeedback->rating = $request->rating;
        $itemFeedback->details = $request->details;
        $itemFeedback->item_id = $request->item_id;
        return $itemFeedback;
    }

    private function validate(Request $request)
    {
        $rules = [
            'rating' => 'required|integer|min:0|max:5',
            'details' => 'required|string',
            'item_id' => 'required|exists:items,id|integer'
        ];
        $unique = Rule::unique('item_feedbacks')->where(function ($query) use ($request) {
            $query->where('item_id', $request->item_id)
                ->where('user_id', auth()->user()->id);
        });
        if ($request->method() == 'POST')
            $rules['item_id'] .= "|$unique";
        $request->validate($rules);
    }
}
