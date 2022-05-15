<?php

namespace App\Http\Module\Faq\Mapper;

use App\Http\Module\Faq\Request\FaqRequest;
use App\Models\Faq;

class FaqMapper
{
    public function faqRequestToFaq(FaqRequest $request): Faq
    {
        return new Faq($request->all());
    }
}
