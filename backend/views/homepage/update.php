<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Homepage */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => ucfirst(Yii::$app->controller->id),
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ucfirst(Yii::$app->controller->id)), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="homepage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type'  => $type,
    ]) ?>

</div>
