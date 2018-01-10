<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaAgency */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Agency',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-agency-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
