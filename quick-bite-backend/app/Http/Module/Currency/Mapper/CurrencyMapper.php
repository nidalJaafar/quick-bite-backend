<?php

namespace App\Http\Module\Currency\Mapper;

use App\Http\Module\Currency\Request\CurrencyRequest;
use App\Models\Currency;

class CurrencyMapper
{
    public function currencyRequestToCurrency(CurrencyRequest $request): Currency
    {
        return new Currency($request->all());
    }
}
