<?php

namespace App\Http\Services;

use App\Http\Mappers\ImageMapper;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageCollection;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Throwable;

class ImageService
{

    private ImageMapper $mapper;

    public function __construct(ImageMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getImages(): ImageCollection
    {
        $images = Image::with('item')->get();
        return new ImageCollection($images);
    }

    public function getImage(Image $image): ImageResource
    {
        $image->load('item');
        return new ImageResource($image);
    }

    /**
     * @throws Throwable
     */
    public function createImage(ImageRequest $request)
    {
        $this->mapper->imageRequestToImage($request)->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function updateImage(ImageRequest $request, Image $image)
    {
        $image->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteImage(Image $image)
    {
        $image->deleteOrFail();
    }
}
