<?php

namespace App\Http\Mappers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;

class CurrencyMapper
{
    public function currencyRequestToCurrency(CurrencyRequest $request): Currency
    {
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;
        return $currency;
    }
}
