<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\OaTour */


$this->title = 'T' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="oa-tour-view">

    <p>
	    <?php
		if($model->close == 'Yes'):
			if($permission['isAdmin']):
	        	echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
	        endif;
	    else:
	        echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
	    endif;
	    ?>
	    
	    <?php
	    if($permission['canDel'] && $model->close == 'No' && $dataProvider->totalCount == 0 && $dataProviderBC->totalCount == 0):
	        echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
	            'class' => 'btn btn-danger',
	            'data' => [
	                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
	                'method' => 'post',
	            ],
	        ]);
		endif;
       ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
			    'attribute' => 'id',
	            'value' => 'T'. $model->id
			],
            [
			    'attribute' => 'inquiry_id',
	            'value' => 'Q'. $model->inquiry_id
			],
            'creator',
            'create_time',
            'update_time',
            [
			    'attribute' => 'inquiry_source',
			    'captionOptions' => ['class' => 'important-info'],
			],
            [
			    'attribute' => 'language',
			    'captionOptions' => ['class' => 'important-info'],
			],
            [
			    'attribute' => 'agent',
			    'captionOptions' => ['class' => 'important-info'],
			],
            'co_agent',
            'operator',
            'stage',
            [
			    'attribute' => 'tour_price',
			    'captionOptions' => ['class' => 'important-info'],
                'value' => call_user_func(function($data) {
	                $warning = '';
                    if(!empty($data['tour_price'])): 
                    	if($data['close'] == 'No' && (($data['tour_price'] - $data['estimated_cost'])/$data['tour_price']) < 0.2):
							$data['tour_price'] .= ' - <span style="color: #c55">Low profit risk!</span>';
                    	endif;
                	endif;
                	
                	return $data['tour_price'];
                }, $model),
                'format' => 'raw'
			],
            [
			    'attribute' => 'estimated_cost',
			    'captionOptions' => ['class' => 'important-info'],
			],
            'payment',
            'accounting_sales_amount',
            'accounting_total_cost',
            'accounting_hotel_flight_train_cost',
            'close',
            [
			    'attribute' => 'tour_type',
			    'captionOptions' => ['class' => 'important-info'],
			],
            [
			    'attribute' => 'organization',
			    'contentOptions' => ['class' => 'view'],
			    'format' => 'html'
			],
            'vip',
            [
			    'attribute' => 'tour_start_date',
			    'captionOptions' => ['class' => 'important-info'],
			],
            [
			    'attribute' => 'tour_end_date',
			    'captionOptions' => ['class' => 'important-info'],
			],
            [
			    'attribute' => 'cities',
			    'captionOptions' => ['class' => 'important-info'],
			],
            [
			    'attribute' => 'number_of_travelers',
			    'captionOptions' => ['class' => 'important-info'],
			],
            [
			    'attribute' => 'traveler_info',
			    'contentOptions' => ['class' => 'view'],
			    'format' => 'html'
			],
			'group_type',
			'country',
            [
			    'attribute' => 'contact',
			    'captionOptions' => ['class' => 'important-info'],
			],
            [
			    'attribute' => 'email',
			    'format' => 'email',
			    'captionOptions' => ['class' => 'important-info'],
			],
            [
			    'attribute' => 'other_contact_info',
			    'contentOptions' => ['class' => 'view'],
			    'format' => 'html'
			],
			[
			    'attribute' => 'itinerary_quotation_english',
			    'contentOptions' => ['class' => 'view-long'],
			    'format' => 'html'
			],
            [
			    'attribute' => 'itinerary_quotation_other_language',
			    'contentOptions' => ['class' => 'view-long'],
			    'format' => 'html'
			],
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
			[
				'attribute' => 'attachment',
				'format' => 'html'
			]
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
			        ],
                    [
	                    'attribute' => 'create_time',
	                    'label' => 'Create Date',
	                    'format' => ['date', 'php:Y-m-d']
                    ],
                    [
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
                    [
                    	'attribute' => 'status',
                    	'value' => function($data) {
					        return $data->status == 0 ? 'Not Paid' : 'Paid';
	                    }
                    ],
                    [
                    	'attribute' => 'receit_cny_amount',
                    	'label' => 'Receipt Amount'
                    ],
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
    <?= (!$permission['canAddPayment'] || $model->close == 'Yes') ? '' : "<a href='".Url::to(['oa-payment/create', 'tour_id'=>$model->id])."' target='_blank'>".Html::button(Yii::t('app', 'Add Payment Item'), ['class' => 'btn btn-primary']).'</a>' ?>
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
			        ],
                    [
	                    'attribute' => 'create_time',
	                    'label' => 'Create Date',
	                    'format' => ['date', 'php:Y-m-d']
                    ],
                    [
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
                    'book_date',
                    [
                        'attribute'=>'need_to_pay',
                        'value' => function ($data) {
                            return Yii::$app->params['yes_or_no'][$data->need_to_pay];
                        }
                    ],
                    [
                    	'attribute' => 'cny_amount',
                    	'label' => 'Estimated Amount'
                    ],
                    'due_date_for_pay',
                    [
                        'attribute'=>'pay_status',
                        'value' => function ($data) {
	                        
	                        if(is_null($data->pay_status)):
	                        	$data->pay_status = 0;
	                        endif;
	                        
                            return Yii::$app->params['yes_or_no'][$data->pay_status];
                        }
                    ],
                    [
                    	'attribute' => 'pay_amount',
                    	'label' => 'Pay Amount'
                    ],
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
    <?= (!$permission['canAddBookCost'] || $model->close == 'Yes') ? '' : "<a href='".Url::to(['oa-book-cost/create', 'tour_id'=>$model->id])."' target='_blank'>".Html::button(Yii::t('app', 'Add Book Cost Item'), ['class' => 'btn btn-primary']).'</a>' ?>
    </div>

</div>
