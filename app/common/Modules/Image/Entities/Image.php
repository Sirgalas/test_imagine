<?php

namespace common\Modules\Image\Entities;

use common\Modules\Image\Enums\ResizeEnum;
use common\Modules\Image\Forms\ImageForms;
use common\Modules\Image\Services\Type\Gif;
use common\Modules\Image\Services\Type\Jpeg;
use common\Modules\Image\Services\Type\Png;
use common\Modules\Image\Services\Type\TypeImage;
use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $name
 * @property string $extension
 * @property string $url
 */
class Image extends \yii\db\ActiveRecord
{
    public const URL = 'uploads';
    public static function create(ImageForms $forms): self
    {
        $image = new self();
        $image->name = $forms->name;
        $image->extension = $forms->extension;
        $image->url = $forms->url;
        return $image;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    public function getFullImage(string $type = null) {
        if($type) {
            return sprintf('%s/%s-%s.%s',$this->getDirectory(),$this->name,$type,$this->extension);
        }
        return sprintf('%s/%s.%s',$this->getDirectory(),$this->name,$this->extension);
    }

    public function getDirectory(): string
    {
        return sprintf('/%s/%s/%s',Yii::getAlias('@frontendWeb'),self::URL, $this->url);
    }

    public function getType(): TypeImage
    {
        if($this->extension == 'png') {
            return new Png();
        }
        if($this->extension == 'jpg') {
            return new Jpeg();
        }
        return new Gif();

    }
}
