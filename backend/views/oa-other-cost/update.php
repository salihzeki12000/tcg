<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaOtherCost */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Other Cost',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Other Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-other-cost-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
