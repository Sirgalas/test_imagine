<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Follow';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-follow">
    <h1><?= Html::encode($this->title) ?></h1>

    <span class="follow unfollow" data-follow="true">follow</span>

</div>
