<?php

namespace App\Http\Mappers;

use App\Http\Requests\ImageRequest;
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
