<?php

namespace App\Http\Controllers;

use App\Http\Resources\CollectionResource;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $currencies = Currency::all();
        return response()->json(['currencies' => new CollectionResource($currencies)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->setValues($request, new Currency())->save();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $currency = Currency::findOrFail($id);
        return response()->json(['currency' => new CurrencyResource($currency)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $this->setValues($request, Currency::findOrFail($id))->save();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Currency::findOrFail($id)->destroy($id);
        return response()->json(status: 204);
    }

    private function setValues(Request $request, Currency $currency): Currency
    {
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;
        return $currency;
    }
}
