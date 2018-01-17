<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
	    if($permission['canAddTour'] && !$inquiryAssignedToTour):
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
			    'attribute' => 'original_inquiry',
			    'contentOptions' => ['class' => 'view-long'],
			    'captionOptions' => ['class' => 'important-info'],
			    'format' => 'html'
			],
        ],
    ]) ?>

</div>
