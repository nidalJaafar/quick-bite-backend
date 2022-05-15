<?php

namespace App\Http\Module\Image\Mapper;

use App\Http\Module\Image\Request\ImageRequest;
use App\Models\Image;

class ImageMapper
{
    public function imageRequestToImage(ImageRequest $request): Image
    {
        return new Image($request->all());
    }
}
