<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitFeedbackRequest;
use App\Http\Services\VisitFeedbackService;
use App\Models\VisitFeedback;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

class VisitFeedbackController extends Controller
{
    private VisitFeedbackService $service;

    /**
     * @param VisitFeedbackService $service
     */
    public function __construct(VisitFeedbackService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(['visit_feedbacks' => $this->service->getVisitFeedbacks()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VisitFeedbackRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(VisitFeedbackRequest $request)
    {
        $this->authorize('create', VisitFeedback::class);
        $this->service->createVisitFeedback($request);
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
        return response()->json(['visit_feedback' => $this->service->getVisitFeedback($visitFeedback)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VisitFeedbackRequest $request
     * @param VisitFeedback $visitFeedback
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(VisitFeedbackRequest $request, VisitFeedback $visitFeedback)
    {
        $this->authorize('update', $visitFeedback);
        $this->service->updateVisitFeedback($request, $visitFeedback);
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
        $this->authorize('delete', $visitFeedback);
        $this->service->deleteVisitFeedback($visitFeedback);
        return response()->json(status: 204);
    }

}
