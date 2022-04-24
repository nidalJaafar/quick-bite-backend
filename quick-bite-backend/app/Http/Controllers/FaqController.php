<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqCollection;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
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
     */
    public function store(Request $request)
    {
        $this->setValues($request, new Faq())->save();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $faqs = Faq::findOrFail($id);
        return response()->json(['FAQs' => new FaqResource($faqs)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $this->setValues($request, Faq::findOrFail($id))->save();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        Faq::findOrFail($id)->destroy();
        return response()->json(status:204);
    }
}
