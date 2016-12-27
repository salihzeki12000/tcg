<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExchangeUsd */

$this->title = Yii::t('app', 'Create Exchange USD');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Exchange USD'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-usd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
