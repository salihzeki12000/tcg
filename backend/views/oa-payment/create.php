<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaPayment */

$this->title = Yii::t('app', 'Create Oa Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
