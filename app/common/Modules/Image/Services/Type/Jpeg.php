<?php

declare(strict_types=1);

namespace common\Modules\Image\Services\Type;

class Jpeg implements TypeImage
{

    public function open(string $path): \GdImage
    {
        return imagecreatefromjpeg($path);
    }

    public function save(\GdImage $image, string $filename): bool
    {
        return imagejpeg($image, $filename, 100);
    }
}