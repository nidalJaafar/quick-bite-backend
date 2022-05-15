<?php

namespace App\Http\Module\Currency\Service;

use App\Http\Module\Currency\Mapper\CurrencyMapper;
use App\Http\Module\Currency\Request\CurrencyRequest;
use App\Http\Module\Currency\Resource\CurrencyCollection;
use App\Http\Module\Currency\Resource\CurrencyResource;
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
