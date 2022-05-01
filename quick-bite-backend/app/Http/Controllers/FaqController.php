<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqCollection;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Faq::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $faqs = Faq::all();
        return response()->json(['FAQs' => new FaqCollection($faqs)]);
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
        $this->setValues($request, new Faq())->saveOrFail();
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
        return response()->json(['FAQs' => new FaqResource($faq)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Faq $faq
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, Faq $faq)
    {
        $this->setValues($request, $faq)->saveOrFail();
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
        $faq->deleteOrFail();
        return response()->json(status: 204);
    }

    private function setValues(Request $request, Faq $faq): Faq
    {
        $this->validate($request);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        return $faq;
    }
    private function validate(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);
    }
}
