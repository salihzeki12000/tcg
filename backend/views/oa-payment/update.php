<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaPayment */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Payment',
]) . 'P' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'P' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-payment-update">

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
