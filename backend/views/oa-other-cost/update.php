<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaOtherCost */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Oa Other Cost',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Other Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-other-cost-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
