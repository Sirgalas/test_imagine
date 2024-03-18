<?php

declare(strict_types=1);

namespace common\Modules\Image\Forms;

use common\Modules\Image\Entities\Image;
use yii\base\Model;

class ImageForms extends Model
{

    public string $name;
    public string $extension;
    public string $url;
    public int $id;

    public function __construct(Image $image = null,$config = [])
    {
        parent::__construct($config);
        if($image instanceof Image) {
            $this->id = $image->id;
            $this->name = $image->name;
            $this->extension = $image->extension;
            $this->url = $image->url;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'extension', 'url'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 610],
            [['extension'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'extension' => 'Расширение',
        ];
    }
}