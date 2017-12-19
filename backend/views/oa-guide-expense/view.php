<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OaGuideExpense */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Guide Expenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-guide-expense-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tour_id',
            'guide_id',
            'start_date',
            'end_date',
            'guide_service_fee',
            'amount_spendings',
            'details_spendings:ntext',
            'cash_collect:ntext',
            'notes:ntext',
        ],
    ]) ?>

</div>
