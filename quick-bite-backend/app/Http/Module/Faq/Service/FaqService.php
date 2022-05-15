<?php

namespace App\Http\Module\Faq\Service;

use App\Http\Module\Faq\Mapper\FaqMapper;
use App\Http\Module\Faq\Request\FaqRequest;
use App\Http\Module\Faq\Resource\FaqCollection;
use App\Http\Module\Faq\Resource\FaqResource;
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
