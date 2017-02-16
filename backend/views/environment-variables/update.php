<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EnvironmentVariables */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Environment Variables',
]) . $model->key;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Environment Variables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->key, 'url' => ['view', 'id' => $model->key]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="environment-variables-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
