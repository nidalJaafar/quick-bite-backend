<?php

namespace App\Http\Module\Menu\Service;

use App\Http\Module\Menu\Mapper\MenuMapper;
use App\Http\Module\Menu\Request\MenuRequest;
use App\Http\Module\Menu\Resource\MenuCollection;
use App\Http\Module\Menu\Resource\MenuResource;
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
