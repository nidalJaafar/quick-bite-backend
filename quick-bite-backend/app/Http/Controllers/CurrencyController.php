<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Currency::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $currencies = Currency::all();
        return response()->json(['currencies' => new CurrencyCollection($currencies)]);
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
        $this->setValues($request, new Currency())->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Currency $currency
     * @return JsonResponse
     */
    public function show(Currency $currency)
    {
        return response()->json(['currency' => new CurrencyResource($currency)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Currency $currency
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, Currency $currency)
    {
        $this->setValues($request,$currency)->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Currency $currency
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Currency $currency)
    {
        $currency->deleteOrFail();
        return response()->json(status: 204);
    }

    private function setValues(Request $request, Currency $currency): Currency
    {
        $this->validate($request);
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;
        return $currency;
    }

    private function validate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'symbol' => 'required',
            'rate' => 'required|integer',
        ]);
    }
}
