<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-payment-index">

    <p>
        <?= true ? '' : Html::a(Yii::t('app', 'Create Payment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
				'label'=>'ID',
				'attribute'=>'id',
				'format' => 'raw',
				'value' => function($model) {
					return '<a href="' . Url::to(['oa-payment/view', 'id'=>$model['id']]) . '" target="_blank">P' . $model['id'] . '</a>';
				}
            ],
            [
				'label'=>'Tour ID',
				'attribute'=>'tour_id',
				'format' => 'raw',
				'value' => function($model) {
					return '<a href="' . Url::to(['oa-tour/view', 'id'=>$model['tour_id']]) . '" target="_blank">T' . $model['tour_id'] . '</a>';
				}
            ],
            [
				'label'=>'Start Date',
				'value' => function($model) {
					return common\models\Tools::getTourStartDate($model['tour_id']);
				}
            ],
            'payer',
            [
                'attribute'=>'type',
                'filter'=> common\models\Tools::getEnvironmentVariable('oa_pay_type'),
                'value' => function ($data) {
                    return $data['type'];
                }
            ],
            [
				'label'=>'Amount',
				'attribute'=>'cny_amount',
            ],
            'due_date',
            [
                'attribute'=>'status',
                'filter'=> common\models\Tools::getEnvironmentVariable('oa_pay_status'),
                'value' => function ($data) {
                    return $data['status'] == 0 ? 'Not Paid' : 'Paid';
                }
            ],
            [
				'label'=>'Receipt Amount',
				'attribute'=>'receit_cny_amount',
            ],
            'receit_date',
            [
                'attribute' => 'pay_method',
                'value' => function ($data) {
                    $oa_pay_methods = \common\models\Tools::getEnvironmentVariable('oa_pay_method');
					if(!empty($data['pay_method'])) {
						return $oa_pay_methods[$data['pay_method']];
        			}
        			
        			return '-';
                }
            ],
            // 'create_time',
            // 'update_time',
            // 'receit_account',
            // 'receit_date',
            // 'cc_note_signing',
            // 'note:ntext',

            /* [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['oa-payment/view', 'id'=>$model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['oa-payment/delete', 'id'=>$model->id]);
                    }
                },
            ], */
        ],
    ]); ?>
</div>
