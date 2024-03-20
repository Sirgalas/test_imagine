<?php

declare(strict_types=1);

namespace common\Modules\Image\Services\Type;

use common\Modules\Image\Entities\Image;

class Gif implements TypeImage
{

    public function open(string $path): \GdImage
    {
        return imagecreatefromgif($path);
    }


    public function resize(Image $imageModel, int $size, string $value): void
    {
        list($width,$height) = getimagesize($imageModel->getFullImage());
        $percent = $size/$height;
        $newHeight = (int)ceil($height * $percent);
        $newWidth = (int)ceil($width * $percent);
        $image_p = imagecreatetruecolor($newWidth, $newHeight);
        $image = imagecreatefromgif($imageModel->getFullImage());
        imagealphablending( $image, true);
        imagesavealpha($image, true);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagegif($image, $imageModel->getFullImage($value));
    }


}