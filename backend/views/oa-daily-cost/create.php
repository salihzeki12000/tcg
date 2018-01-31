<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaDailyCost */

$this->title = Yii::t('app', 'Create Daily Cost');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daily Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="oa-daily-cost-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>