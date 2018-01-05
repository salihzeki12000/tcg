<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaTour */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tour',
]) . 'T' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'T' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-tour-update">

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
