<?php

namespace frontend\controllers;

use common\Modules\Image\Services\ImageService;
use frontend\models\FileModel;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private ImageService $imageService;

    public function __construct($id, $module,  ImageService $imageService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->imageService = $imageService;
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new FileModel();
        //dd(Yii::$app);
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->validate()) {
                $this->imageService->upload($model->imageFile);
            }
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionError(){
        return $this->render('error');
    }

    public function actionFollow() {
        return $this->render('follow');
    }

}
