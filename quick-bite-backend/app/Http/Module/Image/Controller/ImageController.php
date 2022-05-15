<?php

namespace App\Http\Module\Image\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\Image\Request\ImageRequest;
use App\Http\Module\Image\Service\ImageService;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
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
    public function index(): JsonResponse
    {
        return response()->json(['images' => $this->service->getImages()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ImageRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(ImageRequest $request): JsonResponse
    {
        $this->authorize('create', Image::class);
        $this->service->createImage($request);
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return StreamedResponse
     */
    public function show(Image $image): StreamedResponse
    {
        return $this->service->getImage($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Image $image): JsonResponse
    {
        $this->authorize('delete', $image);
        $this->service->deleteImage($image);
        return response()->json(status: 204);
    }
}
