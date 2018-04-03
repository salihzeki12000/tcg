<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaVoucher */

$this->title = Yii::t('app', 'Create Voucher');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vouchers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-voucher-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
