<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OaBookCost */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Book Cost',
]) . 'C' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Book Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'C' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oa-book-cost-update">

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
