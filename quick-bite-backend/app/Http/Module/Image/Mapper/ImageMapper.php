<?php

namespace App\Http\Module\Image\Mapper;

use App\Http\Module\Image\Request\ImageRequest;
use App\Models\Image;

class ImageMapper
{
    public function imageRequestToImage(ImageRequest $request): Image
    {
        $image = new Image();
        $image->path = $request->path;
        $image->item_id = $request->item_id;
        return $image;
    }
}
