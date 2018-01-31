<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaDailyCostSubtype */

$this->title = Yii::t('app', 'Create Oa Daily Cost Subtype');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Daily Cost Subtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-daily-cost-subtype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
