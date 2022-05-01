<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisitFeedbackCollection;
use App\Http\Resources\VisitFeedbackResource;
use App\Models\VisitFeedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class VisitFeedbackController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(VisitFeedback::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $visitFeedbacks = VisitFeedback::with('user')->get();
        return response()->json(['visit_feedbacks' => new VisitFeedbackCollection($visitFeedbacks)]);
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
        $this->setValues($request, new VisitFeedback())->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param VisitFeedback $visitFeedback
     * @return JsonResponse
     */
    public function show(VisitFeedback $visitFeedback)
    {
        $visitFeedback->load('user');
        return response()->json(['visit_feedback' => new VisitFeedbackResource($visitFeedback)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param VisitFeedback $visitFeedback
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, VisitFeedback $visitFeedback)
    {
        $this->setValues($request, $visitFeedback)->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VisitFeedback $visitFeedback
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(VisitFeedback $visitFeedback)
    {
        $visitFeedback->deleteOrFail();
        return response()->json(status: 204);
    }

    private function setValues(Request $request, VisitFeedback $visitFeedback): VisitFeedback
    {
        $this->validate($request);
        $visitFeedback->user_id = $request->user_id;
        $visitFeedback->rating = $request->rating;
        $visitFeedback->details = $request->details;
        return $visitFeedback;
    }
    private function validate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|integer',
            'rating' => 'required|min:0|max:5|integer',
            'details' => 'required|string',
        ]);
    }
}
