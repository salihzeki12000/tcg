<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaGuide */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Guide',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guides'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-guide-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
