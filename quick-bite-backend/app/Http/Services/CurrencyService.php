<?php

namespace App\Http\Services;

use App\Http\Mappers\CurrencyMapper;
use App\Http\Requests\CurrencyRequest;
use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Throwable;

class CurrencyService
{
    private CurrencyMapper $mapper;

    public function __construct(CurrencyMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @throws Throwable
     */
    public function createCurrency(CurrencyRequest $request)
    {
        $this->mapper->currencyRequestToCurrency($request)->saveOrFail();
    }

    public function getCurrency(Currency $currency): CurrencyResource
    {
        return new CurrencyResource($currency);
    }

    public function getCurrencies(): CurrencyCollection
    {
        return new CurrencyCollection(Currency::all());
    }

    /**
     * @throws Throwable
     */
    public function updateCurrency(CurrencyRequest $request, Currency $currency)
    {
        $currency->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteCurrency(Currency $currency)
    {
        $currency->deleteOrFail();
    }
}
