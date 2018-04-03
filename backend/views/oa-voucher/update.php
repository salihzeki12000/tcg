<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaVoucher */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Voucher',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vouchers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-voucher-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
