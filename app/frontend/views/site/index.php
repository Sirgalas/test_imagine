<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
use yii\widgets\ActiveForm;
?>
<div class="site-index">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button class="btn btn-primary">Submit</button>

    <?php ActiveForm::end() ?>
</div>
