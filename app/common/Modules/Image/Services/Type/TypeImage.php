<?php

namespace common\Modules\Image\Services\Type;


interface TypeImage
{
    public function open(string $path): \GdImage;

    public function save(\GdImage $image,string $filename):bool;
}