<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqRequest;
use App\Http\Services\FaqService;
use App\Models\Faq;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

class FaqController extends Controller
{
    private FaqService $service;

    public function __construct(FaqService $service)
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
        return response()->json(['FAQs' => $this->service->getFaqs()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FaqRequest $request
     * @return JsonResponse
     * @throws Throwable
     * @throws AuthorizationException
     */
    public function store(FaqRequest $request)
    {
        $this->authorize('create', Faq::class);
        $this->service->createFaq($request);
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Faq $faq
     * @return JsonResponse
     */
    public function show(Faq $faq)
    {
        return response()->json(['FAQ' => $this->service->getFaq($faq)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FaqRequest $request
     * @param Faq $faq
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $this->authorize('update', $faq);
        $this->service->updateFaq($request, $faq);
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Faq $faq
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Faq $faq)
    {
        $this->authorize('delete', $faq);
        $this->service->deleteFaq($faq);
        return response()->json(status: 204);
    }

}
