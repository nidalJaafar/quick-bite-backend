<?php

namespace App\Http\Module\VisitFeedback\Mapper;

use App\Http\Module\VisitFeedback\Request\VisitFeedbackRequest;
use App\Models\VisitFeedback;
use function auth;

class VisitFeedbackMapper
{
    public function visitFeedbackRequestToVisitFeedback(VisitFeedbackRequest $request): VisitFeedback
    {
        $visitFeedback = new VisitFeedback($request->all());
        $visitFeedback->user_id = auth()->user()->id;
        return $visitFeedback;
    }
}
