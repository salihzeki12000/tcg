<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OaDailyCost */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daily Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="oa-daily-cost-view">

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
            'create_time',
            'creator',
	        [
				'attribute' => 'type',
				'value' => call_user_func(function ($model) {
					$data = \common\models\OaDailyCostType::findOne($model->type);
					return $data['name'];
				}, $model),
	        ],
	        [
				'attribute' => 'sub_type',
				'value' => call_user_func(function ($model) {
					$data = \common\models\OaDailyCostSubtype::findOne($model->sub_type);
					return $data['name'];
				}, $model),
	        ],
            'amount',
            [
                'attribute'=>'pay_status',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_pay_status'),
				'value' => call_user_func(function ($model) {
                    return $model->pay_status == 0 ? 'Not Paid' : 'Paid';
				}, $model),
            ],
            'pay_date',
            'pay_method',
            'notes:ntext',
        ],
    ]) ?>

</div>