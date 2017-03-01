<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FormCard */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Form Card',
]) . $model->client_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->client_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="form-card-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
