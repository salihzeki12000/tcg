<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaPayment */

$this->title = Yii::t('app', 'Create Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-payment-create">

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
