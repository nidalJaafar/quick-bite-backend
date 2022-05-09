<?php

namespace App\Http\Mappers;

use App\Http\Requests\VisitFeedbackRequest;
use App\Models\VisitFeedback;

class VisitFeedbackMapper
{
    public function visitFeedbackRequestToVisitFeedback(VisitFeedbackRequest $request): VisitFeedback
    {
        $visitFeedback = new VisitFeedback();
        $visitFeedback->user_id = auth()->user()->id;
        $visitFeedback->rating = $request->rating;
        $visitFeedback->details = $request->details;
        return $visitFeedback;
    }
}
