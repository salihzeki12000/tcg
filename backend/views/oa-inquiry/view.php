<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\OaInquiry */

$this->title = 'Q' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inquiries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$inquiryAssignedToTour =  \common\models\Tools::inquiryAssignedToTour($model->id);

?>

<div class="oa-inquiry-view">
 
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
		if($permission['canDel'] && $model->close == 'No' && !$inquiryAssignedToTour):
	        echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
	            'class' => 'btn btn-danger',
	            'data' => [
	                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
	                'method' => 'post',
	            ],
			]);
        endif;
        ?>
        
        <?php
	    if($permission['canAddTour'] && !$inquiryAssignedToTour && $model->inquiry_status == 'Waiting for Payment'):
        	echo Html::a(Yii::t('app', 'Add Tour'), ['oa-tour/create', 'inquiry_id' => $model->id], ['class' => 'btn btn-primary']);
        endif;
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
			    'attribute' => 'id',
	            'value' => 'Q'. $model->id
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
            'inquiry_status',
            'estimated_cny_amount',
            'probability',
            'close',
            [
			    'attribute' => 'close_report',
			    'contentOptions' => ['class' => 'view'],
			    'format' => 'html'
			],
            'tour_type',
            [
			    'attribute' => 'organization',
			    'contentOptions' => ['class' => 'view'],
			    'format' => 'html'
			],
            'priority',
            [
			    'attribute' => 'tour_start_date',
			    'captionOptions' => ['class' => 'important-info'],
			],
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
			
            'task_remind',
            'task_remind_date',
            [
			    'attribute' => 'follow_up_record',
			    'contentOptions' => ['class' => 'view-long'],
			    'format' => 'html'
			],
            [
			    'attribute' => 'tour_schedule_note',
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
			],
            [
			    'attribute' => 'original_inquiry',
			    'contentOptions' => ['class' => 'view-long'],
			    'captionOptions' => ['class' => 'important-info'],
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
			                return Html::a('P'. $data['id'], ['oa-payment/view', 'id' => $data['id']], ['data-pjax' => 0, 'target' => "_blank"]);
			            },
			        ],
                    [
	                    'attribute' => 'payer_type',
	                    'label' => 'Payer',
	                    'value' => function($data) {
		                    $payer_types = \common\models\Tools::getEnvironmentVariable('oa_payer_type');
					        if(!empty($data['payer_type'])):
					            return $payer_types[$data['payer_type']];
					        else:
					        	return '-';
					        endif;
	                    }
                    ],
                    [
	                    'attribute' => 'payer',
	                    'label' => 'Guest Name',
                    ],
                    'type',
                    'cny_amount',
                    'due_date',
                    [
	                    'attribute' => 'pay_method',
	                    'value' => function($data) {
		                    $payment_methods = \common\models\Tools::getEnvironmentVariable('oa_pay_method');
					        if(!empty($data['pay_method'])):
					            return $payment_methods[$data['pay_method']];
					        else:
					        	return '-';
					        endif;
	                    }
                    ],
                    [
                    	'attribute' => 'status',
                    	'value' => function($data) {
					        return $data['status'] == 0 ? 'Not Paid' : 'Paid';
	                    }
                    ],
                    [
                    	'attribute' => 'receit_cny_amount',
                    	'label' => 'Receipt Amount'
                    ],
                    'receit_date',
                ],
            ]); ?>
    </div>
    <?= (!$permission['canAddPayment'] || $model->close == 'Yes' || $model->inquiry_status != 'Waiting for Payment') ? '' : "<a href='".Url::to(['oa-payment/create', 'inquiry_id'=>$model->id])."' target='_blank'>".Html::button(Yii::t('app', 'Add Payment Item'), ['class' => 'btn btn-primary']).'</a>' ?>
    </div>

</div>
