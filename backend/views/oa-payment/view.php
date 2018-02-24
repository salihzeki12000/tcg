<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OaPayment */

$this->title = 'P' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-payment-view">

    <p>
	    <?php
		if(!$tourClosed):
        	echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        	
        	if($model->status == 0 || is_null($model->status)): echo ' ' . Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            	'class' => 'btn btn-danger',
            	'data' => [
                	'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                	'method' => 'post',
				],
			]);
        	endif;
        endif;
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
			    'attribute' => 'id',
	            'value' => 'P'. $model->id
			],
            [
			    'attribute' => 'inquiry_id',
                'value' => call_user_func(function($data) {
                    if(!empty($data->inquiry_id)): 
                    	return Html::a('Q'. $data->inquiry_id, ['oa-inquiry/view', 'id' => $data->inquiry_id], ['data-pjax' => 0, 'target' => "_blank"]);
                	endif;
                	
                	return '-';
                }, $model),
                'format' => 'raw'
			],
            [
			    'attribute' => 'tour_id',
                'value' => call_user_func(function($data) {
                    if(!empty($data->tour_id)): 
                    	return Html::a('T'. $data->tour_id, ['oa-tour/view', 'id' => $data->tour_id], ['data-pjax' => 0, 'target' => "_blank"]);
                	endif;
                	
                	return '-';
                }, $model),
                'format' => 'raw'
			],
            'create_time',
            'update_time',
            'payer_type',
            'payer',
            'type',
            [
			    'attribute' => 'cny_amount',
	            'label' => 'Amount'
			],
            'due_date',
            'pay_method',
            [
                'attribute'=>'status',
                'value' => $model->status == 0 ? 'Not Paid' : 'Paid',
            ],
            // 'receit_account',
            [
			    'attribute' => 'receit_cny_amount',
	            'label' => 'Receipt Amount'
			],
            [
			    'attribute' => 'transaction_fee',
	            'label' => 'Transaction Fee'
			],
            'receit_date',
            'cc_note_signing',
            'note:ntext',
        ],
    ]) ?>

</div>
