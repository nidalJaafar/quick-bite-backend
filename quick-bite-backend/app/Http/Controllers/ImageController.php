<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Services\ImageService;
use App\Models\Image;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

class ImageController extends Controller
{
    private ImageService $service;

    public function __construct(ImageService $service)
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
        return response()->json(['images' => $this->service->getImages()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ImageRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function store(ImageRequest $request)
    {
        $this->authorize('create', Image::class);
        $this->service->createImage($request);
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
        return response()->json(['image' => $this->service->getImage($image)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ImageRequest $request
     * @param Image $image
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(ImageRequest $request, Image $image)
    {
        $this->authorize('update', $image);
        $this->service->updateImage($request, $image);
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
        $this->authorize('delete', $image);
        $this->service->deleteImage($image);
        return response()->json(status: 204);
    }
}
