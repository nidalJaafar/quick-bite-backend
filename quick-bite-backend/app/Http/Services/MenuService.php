<?php

namespace App\Http\Services;

use App\Http\Mappers\MenuMapper;
use App\Http\Requests\MenuRequest;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Throwable;

class MenuService
{
    private MenuMapper $mapper;

    /**
     * @param MenuMapper $mapper
     */
    public function __construct(MenuMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getMenus(): MenuCollection
    {
        $menus = Menu::with('items.images')->get();
        return new MenuCollection($menus);
    }

    public function getMenu(Menu $menu): MenuResource
    {
        $menu->load('items.images');
        return new MenuResource($menu);
    }

    /**
     * @throws Throwable
     */
    public function createMenu(MenuRequest $request)
    {
        $this->mapper->menuRequestToMenu($request)->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function updateMenu(MenuRequest $request, Menu $menu)
    {
        $menu->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteMenu(Menu $menu)
    {
        $menu->deleteOrFail();
    }


}
