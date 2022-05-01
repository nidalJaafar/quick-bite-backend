<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageCollection;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Image::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
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
    public function store(Request $request)
    {
        $this->setValues($request, new Image())->save();
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return JsonResponse
     */
    public function show(Image $image)
    {
        return response()->json(['image' => new ImageResource($image)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Image $image
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, Image $image)
    {
        $this->setValues($request, $image)->saveOrFail();
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Image $image)
    {
        $image->deleteOrFail();
        return response()->json(status: 204);
    }

    private function setValues(Request $request, Image $image): Image
    {
        $this->validate($request);
        $image->path = $request->path;
        $image->item_id = $request->item_id;
        return $image;
    }
    private function validate(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
            'item_id' => 'required|exists:items,id|integer',
        ]);
    }
}
