<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\OaTour */


$this->title = 'CL T' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="oa-tour-view">

    <!-- <?= DetailView::widget([
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
    ]) ?> -->

	<div id="bar" style="margin-top: 30px">
		<?php
		$types = Yii::$app->params['oa_book_cost_type'];
		$first = 1;
		$marginTop = 0;

		// initialize each type with a 0, meaning that it has not been printed
		foreach($types as $type):
			$types[$type] = 0;
		endforeach;

		foreach($dataProviderBC->models as $mod):
			$type = Yii::$app->params['oa_book_cost_type'][$mod->type];
			
			if(!$types[$type]):
				if(!$first):
					$marginTop = 20;
				endif;
				
	    		echo '<div style="margin-top: ' . $marginTop . 'px; margin-bottom: 5px; font-weight: bold">Your ' . $type . '</div>';
	    		
	    		$types[$type] = 1;	// flag type as printed (value 1)
				$first = 0;
	    	endif;
	    		    	
	    	echo '<div>' . $mod->start_date . ' to ' . $mod->end_date . ': ' . $mod->cl_info . '</div>';
	  	endforeach;
		?>
	</div>
	
    <div style="margin-top: 50px">
	    <button class="btn" data-clipboard-action="copy" data-clipboard-target="#bar">Copy to clipboard</button>
	</div>

    <!-- <div class="form-group">
	    <div id="book-cost_list">
	        <?= GridView::widget([
	                'dataProvider' => $dataProviderBC,
	                'columns' => [
				        /* [
				            'label' => 'ID',
				            'format' => 'raw',
				            'attribute' => 'id',
				            'value' => function ($data) {
				                return Html::a('C'. $data['id'], ['oa-book-cost/view', 'id' => $data->id], ['data-pjax' => 0, 'target' => "_blank"]);
				            },
				        ], */
	                    [
	                        'attribute'=>'type',
	                        'filter'=> Yii::$app->params['oa_book_cost_type'],
	                        'value' => function ($data) {
	                            return Yii::$app->params['oa_book_cost_type'][$data['type']];
	                        }
	                    ],
	                    /* [
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
	                    ], */
	                    'start_date',
	                    'end_date',
	                    'cl_info',
	                    // 'book_status',
	                    // 'book_date',
	                    /* [
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
	                    ], */
	                ],
	            ]); ?>
	    </div>
	    <?= (!$permission['canAddBookCost'] || $model->close == 'Yes') ? '' : "<a href='".Url::to(['oa-book-cost/create', 'tour_id'=>$model->id])."' target='_blank'>".Html::button(Yii::t('app', 'Add Book Cost Item'), ['class' => 'btn btn-primary']).'</a>' ?>
    </div> -->

</div>

<?php
$this->registerJsFile('@web/statics/js/clipboard.min.js',['depends'=>['backend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        var clipboard = new Clipboard('.btn');

	    clipboard.on('success', function(e) {
	        console.log(e);
	    });
	
	    clipboard.on('error', function(e) {
	        console.log(e);
	    });
    });
JS;
$this->registerJs($js);
?>