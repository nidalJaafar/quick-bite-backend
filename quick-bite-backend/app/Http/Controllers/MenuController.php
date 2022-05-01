<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Menu::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $menus = Menu::with('items.images')->get();
        return response()->json(['menus' => new MenuCollection($menus)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $this->setValues($request, new Menu())->saveOrFail();
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
        $menu->load('items.images');
        return response()->json(['menu' => new MenuResource($menu)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Menu $menu
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, Menu $menu)
    {
        $this->setValues($request, $menu)->saveOrFail();
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
        $menu->deleteOrFail();
        return response()->json(status: 204);
    }

    private function setValues(Request $request, Menu $menu): Menu
    {
        $this->validate($request);
        $menu->name = $request->name;
        return $menu;
    }

    private function validate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
    }
}
