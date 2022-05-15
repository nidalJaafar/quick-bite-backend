<?php

namespace App\Http\Module\Menu\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\Menu\Request\MenuRequest;
use App\Http\Module\Menu\Service\MenuService;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

class MenuController extends Controller
{
    private MenuService $service;

    /**
     * @param MenuService $service
     */
    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(['menus' => $this->service->getMenus()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MenuRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(MenuRequest $request)
    {
        $this->authorize('create', Menu::class);
        $this->service->createMenu($request);
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return JsonResponse
     */
    public function show(Menu $menu)
    {
        return response()->json(['menu' => $this->service->getMenu($menu)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuRequest $request
     * @param Menu $menu
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $this->authorize('update', $menu);
        $this->service->updateMenu($request, $menu);
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Menu $menu)
    {
        $this->authorize('delete', $menu);
        $this->service->deleteMenu($menu);
        return response()->json(status: 204);
    }

}
