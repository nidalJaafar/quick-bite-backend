<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisitFeedbackCollection;
use App\Http\Resources\VisitFeedbackResource;
use App\Models\VisitFeedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $visitFeedbacks = VisitFeedback::with('user')->get();
        return response()->json(['visit_feedbacks' => new VisitFeedbackCollection($visitFeedbacks)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->setValues($request, new VisitFeedback())->save();
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
        $visitFeedback = VisitFeedback::with('user')->findOrFail($id);
        return response()->json(['visit_feedback' => new VisitFeedbackResource($visitFeedback)]);
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
        $this->setValues($request, VisitFeedback::findOrFail($id))->save();
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
        VisitFeedback::findOrFail($id)->destroy($id);
        return response()->json(status: 204);
    }

    private function setValues(Request $request, VisitFeedback $visitFeedback): VisitFeedback
    {
        $visitFeedback->user_id = $request->user_id;
        $visitFeedback->rating = $request->rating;
        $visitFeedback->details = $request->details;
        return $visitFeedback;
    }
}
