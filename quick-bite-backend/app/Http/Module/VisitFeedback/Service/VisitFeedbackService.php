<?php

namespace App\Http\Module\VisitFeedback\Service;

use App\Http\Module\VisitFeedback\Mapper\VisitFeedbackMapper;
use App\Http\Module\VisitFeedback\Request\VisitFeedbackRequest;
use App\Http\Module\VisitFeedback\Resource\VisitFeedbackCollection;
use App\Http\Module\VisitFeedback\Resource\VisitFeedbackResource;
use App\Models\VisitFeedback;
use Throwable;
use function auth;

class VisitFeedbackService
{
    private VisitFeedbackMapper $mapper;

    /**
     * @param VisitFeedbackMapper $mapper
     */
    public function __construct(VisitFeedbackMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getVisitFeedbacks(): VisitFeedbackCollection
    {
        $visitFeedbacks = VisitFeedback::with('user')->get();
        return new VisitFeedbackCollection($visitFeedbacks);
    }

    /**
     * @throws Throwable
     */
    public function createVisitFeedback(VisitFeedbackRequest $request)
    {
        $visitFeedback = $this->mapper->visitFeedbackRequestToVisitFeedback($request);
        $visitFeedback->user_id = auth()->user()->id;
        $visitFeedback->saveOrFail();
    }

    public function getVisitFeedback(VisitFeedback $visitFeedback): VisitFeedbackResource
    {
        $visitFeedback->load('user');
        return new VisitFeedbackResource($visitFeedback);
    }

    /**
     * @throws Throwable
     */
    public function updateVisitFeedback(VisitFeedbackRequest $request, VisitFeedback $visitFeedback)
    {
        $visitFeedback->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteVisitFeedback(VisitFeedback $visitFeedback)
    {
        $visitFeedback->deleteOrFail();
    }


}
