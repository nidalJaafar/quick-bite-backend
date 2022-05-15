<?php

namespace App\Http\Module\Menu\Mapper;

use App\Http\Module\Menu\Request\MenuRequest;
use App\Models\Menu;

class MenuMapper
{
    public function menuRequestToMenu(MenuRequest $request): Menu
    {
        return new Menu($request->all());
    }
}
