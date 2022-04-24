<?php

namespace App\Http\Controllers;

use App\Http\Resources\CollectionResource;
use App\Http\Resources\ImageCollection;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $images = Image::with('item')->get();
        return response()->json(['images' => new ImageCollection($images)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->setValues($request, new Image())->save();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $image = Image::with('item')->findOrFail($id);
        return response()->json(['image' => new ImageResource($image)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $this->setValues($request, Image::findOrFail($id))->save();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Image::findOrFail($id)->destroy($id);
        return response()->json(status: 204);
    }

    private function setValues(Request $request, Image $image): Image
    {
        $image->path = $request->path;
        $image->item_id = $request->item_id;
        return $image;
    }
}
