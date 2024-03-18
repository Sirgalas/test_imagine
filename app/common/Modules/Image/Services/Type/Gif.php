<?php

declare(strict_types=1);

namespace common\Modules\Image\Services\Type;

class Gif implements TypeImage
{

    public function open(string $path): \GdImage
    {
        return imagecreatefromgif($path);
    }

    public function save(\GdImage $image, string $filename): bool
    {
        imagealphablending( $image, true);
        imagesavealpha($image, true);
        return imagegif($image, $filename);
    }
}