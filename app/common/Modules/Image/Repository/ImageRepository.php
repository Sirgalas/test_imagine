<?php

declare(strict_types=1);

namespace common\Modules\Image\Repository;

use common\Helpers\ErrorHelper;
use common\Modules\Image\Entities\Image;

class ImageRepository
{
    public function get(int $id):Image
    {
        if(!$image = Image::findOne($id)) {
            throw new \DomainException('Image is not found.');
        }
        return $image;
    }

    public function save(Image $image):Image
    {
        if(!$image->save()) {
            throw new \RuntimeException(ErrorHelper::errorsToStr($image->errors));
        }
        return $image;
    }
}