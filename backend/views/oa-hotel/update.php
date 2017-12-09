<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaHotel */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Oa Hotel',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Hotels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-hotel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>