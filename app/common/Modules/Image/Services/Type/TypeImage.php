<?php

namespace common\Modules\Image\Services\Type;


use common\Modules\Image\Entities\Image;

interface TypeImage
{
    public function open(string $path): \GdImage;


    public function resize(Image $imageModel, int $size, string $value): void;
}