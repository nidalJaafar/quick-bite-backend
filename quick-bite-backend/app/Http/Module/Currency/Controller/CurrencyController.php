<?php

namespace App\Http\Module\Currency\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\Currency\Request\CurrencyRequest;
use App\Http\Module\Currency\Service\CurrencyService;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

class CurrencyController extends Controller
{
    private CurrencyService $service;

    public function __construct(CurrencyService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['currencies' => $this->service->getCurrencies()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CurrencyRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(CurrencyRequest $request): JsonResponse
    {
        $this->authorize('create', Currency::class);
        $this->service->createCurrency($request);
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Currency $currency
     * @return JsonResponse
     */
    public function show(Currency $currency): JsonResponse
    {
        return response()->json(['currency' => $this->service->getCurrency($currency)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CurrencyRequest $request
     * @param Currency $currency
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(CurrencyRequest $request, Currency $currency): JsonResponse
    {
        $this->authorize('update',$currency);
        $this->service->updateCurrency($request, $currency);
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Currency $currency
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Currency $currency): JsonResponse
    {
        $this->authorize('delete', $currency);
        $this->service->deleteCurrency($currency);
        return response()->json(status: 204);
    }
}
