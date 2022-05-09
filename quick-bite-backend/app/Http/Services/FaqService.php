<?php

namespace App\Http\Services;

use App\Http\Mappers\FaqMapper;
use App\Http\Requests\FaqRequest;
use App\Http\Resources\FaqCollection;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Throwable;

class FaqService
{

    private FaqMapper $mapper;

    public function __construct(FaqMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getFaqs(): FaqCollection
    {
        return new FaqCollection(Faq::all());
    }

    public function getFaq(Faq $faq): FaqResource
    {
        return new FaqResource($faq);
    }

    /**
     * @throws Throwable
     */
    public function createFaq(FaqRequest $request)
    {
        $this->mapper->faqRequestToFaq($request)->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function updateFaq(FaqRequest $request, Faq $faq)
    {
        $faq->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteFaq(Faq $faq)
    {
        $faq->deleteOrFail();
    }
}
