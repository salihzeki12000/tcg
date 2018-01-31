<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaDailyCostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daily Costs');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="oa-daily-cost-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Daily Cost'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'showFooter' => true,
        'columns' => [
            [
				'attribute'=>'id',
				'format' => 'raw',
				'value' => function($model) {
					return '<a href="' . Url::to(['oa-daily-cost/view', 'id'=>$model['id']]) . '" target="_blank">' . $model['id'] . '</a>';
				},
				'footer' => 'Total'
            ],
            [
	            'attribute' => 'create_time',
	            'label' => 'Create Date',
	            'value' => function($model) {
		            return date('Y-m-d', strtotime($model->create_time));
	            }
            ],
	        [
	
				'attribute' => 'type',
				'filter' => common\models\Tools::getDailyCostTypes(),
				'value' => function ($data) {
					$data = \common\models\OaDailyCostType::findOne($data['type']);
					return $data['name'];
				}
	        ],
	        [
				'attribute' => 'sub_type',
				'filter' => common\models\Tools::getDailyCostSubtypes($searchModel->type, 1),
				'value' => function ($data) {
					$data = \common\models\OaDailyCostSubtype::findOne($data['sub_type']);
					return $data['name'];
				}
	        ],
            [
                'attribute'=>'amount',
                'label' => 'Amount',
				'footer' => \common\models\Tools::getTotal($dataProvider->models, 'amount'),
            ],
            [
                'attribute'=>'pay_status',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_pay_status'),
                'value' => function ($data) {
                    return $data['pay_status'] == 0 ? 'Not Paid' : 'Paid';
                },
            ],
            'pay_date',
        ],
    ]); ?>
</div>