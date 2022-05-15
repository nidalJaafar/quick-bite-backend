<?php

namespace App\Http\Module\Image\Service;

use App\Http\Module\Image\Mapper\ImageMapper;
use App\Http\Module\Image\Request\ImageRequest;
use App\Http\Module\Image\Resource\ImageCollection;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
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

    public function getImage(Image $image): StreamedResponse
    {
        $image->load('item');
        return Storage::download('public/images/items/'. $image->path);
    }

    /**
     * @throws Throwable
     */
    public function createImage(ImageRequest $request)
    {
        $fileName = time() . '__' . $request->file('path')->getClientOriginalName();
        $request->path = $fileName;
        $request->file('path')->storeAs('public/images/items', $fileName);
        $this->mapper->imageRequestToImage($request)->saveOrFail();
    }

    /**
     * @throws Throwable
     */
    public function deleteImage(Image $image)
    {
        Storage::delete('public/images/items/' . $image->path);
        $image->deleteOrFail();
    }
}
