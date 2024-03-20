<?php

declare(strict_types=1);

namespace common\Modules\Image\Services\Type;

use common\Modules\Image\Entities\Image;

class Jpeg implements TypeImage
{

    public function open(string $path): \GdImage
    {
        return imagecreatefromjpeg($path);
    }

    public function resize(Image $imageModel, int $size, string $value): void
    {
        list($width,$height) = getimagesize($imageModel->getFullImage());
        $percent = $size/$height;
        $newHeight = (int)ceil($height * $percent);
        $newWidth = (int)ceil($width * $percent);
        $image_p = imagecreatetruecolor($newWidth, $newHeight);
        $image = imagecreatefromjpeg($imageModel->getFullImage());
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($image, $imageModel->getFullImage($value));
    }
}