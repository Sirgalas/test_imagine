<?php

declare(strict_types=1);

namespace common\Modules\Image\Services\Type;

class Png implements TypeImage
{
    public function open(string $path): \GdImage
    {
        return imagecreatefrompng($path);
    }

    public function save(\GdImage $image, string $filename): bool
    {
        imagealphablending($image, true);
        imagesavealpha($image, true);
        return imagepng($image, $filename, 100);
    }
}