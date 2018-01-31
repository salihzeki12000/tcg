<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaDailyCost */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Daily Cost',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daily Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="oa-daily-cost-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>