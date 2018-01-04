<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\OaTour */

$this->title = 'T' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-tour-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($permission['canDel']) { ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
			    'attribute' => 'id',
	            'value' => 'T'. $model->id
			],
            'inquiry_id',
            'creator',
            'create_time',
            'update_time',
            'inquiry_source',
            'language',
            'agent',
            'co_agent',
            'operator',
            'stage',
            'tour_price',
            'estimated_cost',
            'payment',
            'accounting_sales_amount',
            'accounting_total_cost',
            'accounting_hotel_flight_train_cost',
            'close'
        ],
    ]) ?>
    
    <div>
	    <hr class="separator">
    </div>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tour_type',
            [
			    'attribute' => 'organization',
			    'contentOptions' => ['class' => 'view'],
			    'format' => 'html'
			],
            'vip',
            'tour_start_date',
            'tour_end_date',
            'cities',
            'number_of_travelers',
            [
			    'attribute' => 'traveler_info',
			    'contentOptions' => ['class' => 'view'],
			    'format' => 'html'
			],
			'group_type',
			'country',
			'contact',
			'email:email',
            [
			    'attribute' => 'other_contact_info',
			    'contentOptions' => ['class' => 'view'],
			    'format' => 'html'
			]
        ],
    ]) ?>
    
    <div>
	    <hr class="separator">
    </div>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
			    'attribute' => 'itinerary_quotation_english',
			    'contentOptions' => ['class' => 'view-long'],
			    'format' => 'html'
			],
            [
			    'attribute' => 'itinerary_quotation_other_language',
			    'contentOptions' => ['class' => 'view-long'],
			    'format' => 'html'
			]
        ],
    ]) ?>
    
    <div>
	    <hr class="separator">
    </div>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'task_remind',
            'task_remind_date',
            [
			    'attribute' => 'tour_schedule_note',
			    'contentOptions' => ['class' => 'view-long'],
			    'format' => 'html'
			],
            [
			    'attribute' => 'note_for_guide',
			    'contentOptions' => ['class' => 'view-long'],
			    'format' => 'html'
			],
            [
			    'attribute' => 'other_note',
			    'contentOptions' => ['class' => 'view-long'],
			    'format' => 'html'
			],
        ],
    ]) ?>

    <div class="form-group">
    <h2 class="control-label">Payment</h2>
    <div id="itinerary_list">
        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
			        [
			            'label' => 'ID',
			            'format' => 'raw',
			            'attribute' => 'id',
			            'value' => function ($data) {
			                return Html::a('P'. $data['id'], ['oa-payment/view', 'id' => $data->id], ['data-pjax' => 0, 'target' => "_blank"]);
			            },
			        ],
			        /* [
			            'label' => 'Tour ID',
			            'format' => 'raw',
			            'attribute' => 'tour_id',
			            'value' => function ($data) use ($model)  {
			                return Html::a('T'. $model->id, ['oa-tour/view', 'id' => $model->id], ['data-pjax' => 0, 'target' => "_blank"]);
			            },
			        ], */
                    [
	                    'attribute' => 'create_time',
	                    'label' => 'Create Date',
	                    'format' => ['date', 'php:Y-m-d']
                    ],
                    /* [
	                    'attribute' => 'update_time',
	                    'label' => 'Update Date',
	                    'format' => ['date', 'php:Y-m-d']
                    ], */
                    'payer',
                    'type',
                    'cny_amount',
                    'due_date',
                    [
	                    'attribute' => 'pay_method',
	                    'value' => function($data) {
		                    $payment_methods = \common\models\Tools::getEnvironmentVariable('oa_pay_method');
					        if(!empty($data->pay_method)):
					            return $payment_methods[$data->pay_method];
					        else:
					        	return '';
					        endif;
	                    }
                    ],
                    'receit_cny_amount',
                    'receit_date',

                    /* [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open" title="View Details"></span>', ['oa-payment/view', 'id' => $model->id], ['data-pjax' => 0, 'target' => "_blank"]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-trash" title="Delete"></span>', ['oa-payment/delete', 'id' => $model->id], ['data-pjax' => 0]);
                                }
                        ],
                    ], */
                ],
            ]); ?>
    </div>
    <?= (!$permission['canAddPayment']) ? '' : "<a href='".Url::to(['oa-payment/create', 'tour_id'=>$model->id])."' target='_blank'>".Html::button(Yii::t('app', 'Add Payment Item'), ['class' => 'btn btn-primary']).'</a>' ?>
    </div>

    <div class="form-group">
    <h2 class="control-label">Book Cost</h2>
    <div id="book-cost_list">
        <?= GridView::widget([
                'dataProvider' => $dataProviderBC,
                'columns' => [
			        [
			            'label' => 'ID',
			            'format' => 'raw',
			            'attribute' => 'id',
			            'value' => function ($data) {
			                return Html::a('C'. $data['id'], ['oa-book-cost/view', 'id' => $data->id], ['data-pjax' => 0, 'target' => "_blank"]);
			            },
			        ],
			        /* [
			            'label' => 'Tour ID',
			            'format' => 'raw',
			            'attribute' => 'tour_id',
			            'value' => function ($data) use ($model) {
			                return Html::a('T'. $model->id, ['oa-tour/view', 'id' => $model->id], ['data-pjax' => 0, 'target' => "_blank"]);
			            },
			        ], */
                    [
	                    'attribute' => 'create_time',
	                    'label' => 'Create Date',
	                    'format' => ['date', 'php:Y-m-d']
                    ],
                    /* [
	                    'attribute' => 'updat_time',
	                    'label' => 'Update Date',
	                    'format' => ['date', 'php:Y-m-d']
                    ], */
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
                            if($data['type'] == OA_BOOK_COST_TYPE_GUIDE)
                            {
					            $fid = ArrayHelper::map(\common\models\OaGuide::find()->where(['id' => $data['fid']])->all(), 'id', 'name');
					            if(array_key_exists($data['fid'], $fid))
					            {
					                $data['fid'] = $fid[$data['fid']];
					            }
					        }
					        elseif($data['type'] == OA_BOOK_COST_TYPE_HOTEL)
					        {
					            $fid = ArrayHelper::map(\common\models\OaHotel::find()->where(['id' => $data['fid']])->all(), 'id', 'name');
					            if(array_key_exists($data['fid'], $fid))
					            {
					                $data['fid'] = $fid[$data['fid']];
					            }
					        }
					        elseif($data['type'] == OA_BOOK_COST_TYPE_AGENCY)
					        {
					            $fid = ArrayHelper::map(\common\models\OaAgency::find()->where(['id' => $data['fid']])->all(), 'id', 'name');
					            if(array_key_exists($data['fid'], $fid))
					            {
					                $data['fid'] = $fid[$data['fid']];
					            }
					        }
					        elseif($data['type'] == OA_BOOK_COST_TYPE_OTHER)
					        {
					            $fid = ArrayHelper::map(\common\models\OaOtherCost::find()->where(['id' => $data['fid']])->all(), 'id', 'name');
					            if(array_key_exists($data['fid'], $fid))
					            {
					                $data['fid'] = $fid[$data['fid']];
					            }
					        }
					        
					        return $data['fid'];
                        }
                    ],
                    /* [
	                    'attribute' => 'creator',
	                    'value' => function($data) {
		                     $creators = ArrayHelper::map(\common\models\User::find()->where(['id' => $data->creator])->all(), 'id', 'username');
					        if(array_key_exists($data->creator, $creators)):
					            return $creators[$data->creator];
					        else:
					            return 'Webform';
					        endif;
	                    }
                    ], */
                    'start_date',
                    'end_date',
                    'book_status',
                    [
                        'attribute'=>'need_to_pay',
                        'value' => function ($data) {
                            return Yii::$app->params['yes_or_no'][$data->need_to_pay];
                        }
                    ],
                    'cny_amount',
                    'due_date_for_pay',
                    [
                        'attribute'=>'pay_status',
                        'value' => function ($data) {
                            return Yii::$app->params['yes_or_no'][$data->pay_status];
                        }
                    ],
                    'pay_amount',
                    /* [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if($action === 'view') {
                                return Url::to(['oa-book-cost/view', 'id'=>$model->id]);
                            }
                            if($action === 'delete') {
                                return Url::to(['oa-book-cost/delete', 'id'=>$model->id]);
                            }
                        },
                    ], */
                ],
            ]); ?>
    </div>
    <?= (!$permission['canAddBookCost']) ? '' : "<a href='".Url::to(['oa-book-cost/create', 'tour_id'=>$model->id])."' target='_blank'>".Html::button(Yii::t('app', 'Add Book Cost Item'), ['class' => 'btn btn-primary']).'</a>' ?>
    </div>

</div>
