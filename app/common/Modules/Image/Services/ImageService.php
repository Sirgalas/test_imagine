<?php

declare(strict_types=1);

namespace common\Modules\Image\Services;

use common\Modules\Image\Entities\Image;
use common\Modules\Image\Enums\ResizeEnum;
use common\Modules\Image\Forms\ImageForms;
use common\Modules\Image\Repository\ImageRepository;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
class ImageService
{


    public function __construct(private readonly ImageRepository $repository){
    }

    public function upload(UploadedFile $imageFile, string $url = 'image')
    {
        $imageModel = new ImageForms();
        if($imageModel->load(
            ['name' => $imageFile->baseName, 'extension' => $imageFile->extension,'url' => $url],'') &&
            $imageModel->validate())
        {
            $imageCreation = Image::create($imageModel);
            $image = $this->repository->save($imageCreation);
            FileHelper::createDirectory($image->getDirectory(),0777);
            $imageFile->saveAs($image->getFullImage());
            $this->resize($image->id);
            //$this->watermark($image->id);
        }
    }

    public function resize(int $imageId): void
    {
        try{
            $imageModel = ($this->repository->get($imageId));

            array_map(function ($case) use ($imageModel) {
                $imageModel->getType()
                    ->resize(
                        $imageModel,
                        $case->sizeHeight(),
                        $case->value
                    );
            } ,ResizeEnum::cases());
        }catch (\DomainException $exception){
            \Yii::error(implode(",\n",
                $exception->getMessage()));
        }

    }

    public function watermark(int $imageId): void
    {
        $imageModel = ($this->repository->get($imageId));

        array_map(function ($case) use ($imageModel) {

            $watermark = imagecreatefromgif(
                sprintf(
                    '%s/%s/%s',
                    \Yii::getAlias(\Yii::getAlias('@frontendWeb')),
                    'watermark',
                    'watermark.gif')
            );
            $image = $imageModel->getType()->open($imageModel->getFullImage($case->value));
            $sizeX = imagesx($watermark);
            $sizeY = imagesy($watermark);
            $width = imagesx($image) - 20;
            $percent = $sizeX/$width;
            $height = (int)ceil($sizeY/$percent);
            $imageTrueColor = imagecreatetruecolor($width, $height);
            $transparent = imagecolorallocatealpha($imageTrueColor, 0, 0, 0, 127);
            imagefill($imageTrueColor, 0, 0, $transparent);
            imagesavealpha($imageTrueColor, true);
            imagecopyresampled($imageTrueColor,$watermark,0,0,0,0,$width,$height,$sizeX,$sizeY);
            $resultY = (int)ceil((imagesy($image) - $height)/2);
            imagecopy(
                $image,
                $imageTrueColor,
                imagesx($image) - $width - 10,
                $resultY,
                0,
                0,
                imagesx($imageTrueColor),
                imagesy($imageTrueColor)
            );
            if(!$imageModel->getType()->save($image,$imageModel->getFullImage(sprintf('%s-watermark',$case->value)))) {
                \Yii::error(sprintf('image id %s don`t save watermark', $imageModel->id));
            }
        } ,ResizeEnum::cases());
    }
}