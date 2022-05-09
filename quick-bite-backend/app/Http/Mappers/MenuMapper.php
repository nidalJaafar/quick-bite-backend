<?php

namespace App\Http\Mappers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;

class MenuMapper
{
    public function menuRequestToMenu(MenuRequest $request): Menu
    {
        $menu = new Menu();
        $menu->name = $request->name;
        return $menu;
    }
}
