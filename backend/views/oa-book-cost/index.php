<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaBookCostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Book Costs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-book-cost-index">

    <p>
        <?= true ? '' : Html::a(Yii::t('app', 'Create Book Cost'), ['create'], ['class' => 'btn btn-success']) ?>
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
					return '<a href="' . Url::to(['oa-book-cost/view', 'id'=>$model['id']]) . '" target="_blank">C' . $model['id'] . '</a>';
				},
				'footer' => 'Total'
            ],
            [
				'attribute'=>'tour_id',
				'format' => 'raw',
				'value' => function($model) {
					return '<a href="' . Url::to(['oa-tour/view', 'id'=>$model['tour_id']]) . '" target="_blank">T' . $model['tour_id'] . '</a>';
				}
            ],
            [
                'attribute'=>'type',
                'filter'=> Yii::$app->params['oa_book_cost_type'],
                'value' => function ($data) {
                    return Yii::$app->params['oa_book_cost_type'][$data['type']];
                }
            ],
            [
                'attribute'=>'fid',
                'value' => function ($data) {
                    if ($data['type'] == OA_BOOK_COST_TYPE_GUIDE){
			            $fid = ArrayHelper::map(\common\models\OaGuide::find()->where(['id' => $data['fid']])->all(), 'id', 'name');
			            if (array_key_exists($data['fid'], $fid)) {
			                $data['fid'] = $fid[$data['fid']];
			            }
			        }
			        elseif ($data['type'] == OA_BOOK_COST_TYPE_HOTEL) {
			            $fid = ArrayHelper::map(\common\models\OaHotel::find()->where(['id' => $data['fid']])->all(), 'id', 'name');
			            if (array_key_exists($data['fid'], $fid)) {
			                $data['fid'] = $fid[$data['fid']];
			            }
			        }
			        elseif ($data['type'] == OA_BOOK_COST_TYPE_AGENCY) {
			            $fid = ArrayHelper::map(\common\models\OaAgency::find()->where(['id' => $data['fid']])->all(), 'id', 'name');
			            if (array_key_exists($data['fid'], $fid)) {
			                $data['fid'] = $fid[$data['fid']];
			            }
			        }
			        elseif ($data['type'] == OA_BOOK_COST_TYPE_OTHER) {
			            $fid = ArrayHelper::map(\common\models\OaOtherCost::find()->where(['id' => $data['fid']])->all(), 'id', 'name');
			            if (array_key_exists($data['fid'], $fid)) {
			                $data['fid'] = $fid[$data['fid']];
			            }
			        }
                
					return $data['fid'];
                }
            ],
           'start_date',
            'end_date',
            /* [
                'attribute'=>'book_status',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_book_status'),
                'value' => function ($data) {
                    return $data['book_status'];
                }
            ], */
            'book_date',
            [
                'attribute'=>'need_to_pay',
                'filter'=> Yii::$app->params['yes_or_no'],
                'value' => function ($data) {
                    return $data['need_to_pay'] == 0 ? 'No' : 'Yes';
                }
            ],
            [
                'attribute'=>'cny_amount',
                'label' => 'Estimated Amount',
				'footer' => \common\models\Tools::getTotal($dataProvider->models, 'cny_amount'),
            ],
            'due_date_for_pay',
            [
                'attribute'=>'pay_status',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_pay_status'),
                'value' => function ($data) {
                    return $data['pay_status'] == 0 ? 'Not Paid' : 'Paid';
                }
            ],
            [
                'attribute'=>'confirmed_amount',
                'label' => 'Confirmed Amount',
				'footer' => \common\models\Tools::getTotal($dataProvider->models, 'confirmed_amount'),
            ],
            [
                'attribute'=>'pay_amount',
                'label' => 'Accounting Amount',
				'footer' => \common\models\Tools::getTotal($dataProvider->models, 'pay_amount'),
            ],
            [
                'attribute'=>'pay_date',
                'label' => 'Accounting Date',
            ],
            [
                'attribute' => 'pay_method',
                'filter' => \common\models\Tools::getEnvironmentVariable('oa_pay_method'),
                'value' => function ($data) {
                    $oa_pay_methods = \common\models\Tools::getEnvironmentVariable('oa_pay_method');
					if(!empty($data['pay_method'])) {
						return $oa_pay_methods[$data['pay_method']];
        			}
        			
        			return '-';
                }
            ],
            [
                'attribute'=>'transaction_fee',
				'footer' => \common\models\Tools::getTotal($dataProvider->models, 'transaction_fee'),
            ],
            
            // 'create_time',
            // 'updat_time',
            // 'creator',
            // 'cl_info:ntext',
            // 'pay_date',
            // 'transaction_note:ntext',
            // 'note:ntext',

            /* [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['oa-book-cost/view', 'id'=>$model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['oa-book-cost/delete', 'id'=>$model->id]);
                    }
                },
            ], */
        ],
    ]); ?>
</div>
