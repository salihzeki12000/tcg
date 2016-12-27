<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ExchangeUsd */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Exchange USD',
]) . $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Exchange USD'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="exchange-usd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
