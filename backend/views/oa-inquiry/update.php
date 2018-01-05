<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaInquiry */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Inquiry',
]) . 'Q' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inquiries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Q' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-inquiry-update">

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
