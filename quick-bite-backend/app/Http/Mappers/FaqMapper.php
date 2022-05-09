<?php

namespace App\Http\Mappers;

use App\Http\Requests\FaqRequest;
use App\Models\Faq;

class FaqMapper
{
    public function faqRequestToFaq(FaqRequest $request): Faq
    {
        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        return $faq;
    }
}
