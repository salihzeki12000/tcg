<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OaBookCost */

$this->title = 'C' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Book Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-book-cost-view">

    <p>
	    <?php
		if(!$tourClosed):
        	echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        
	        if($model->pay_status == 'Not Paid' || is_null($model->pay_status)): echo ' ' . Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
	            'value' => 'C' . $model->id
            ],
            [
	            'attribute' => 'tour_id',
	            'format' => 'raw',
				'value'=>Html::a('T' . $model->tour_id, ['oa-tour/view', 'id' => $model->tour_id], ['target' => '_blank'])
            ],
            'creator',
            'create_time',
            'updat_time',
            'type',
            'fid',
            'start_date',
            'end_date',
            'book_status',
            'book_date',
            'cl_info:ntext',
            'need_to_pay',
            [
	            'attribute' => 'cny_amount',
	            'label' => 'Estimated Amount'
            ],
            'due_date_for_pay',
            'pay_status',
            'pay_date',
            [
	            'attribute' => 'pay_amount',
	            'label' => 'Pay Amount'
            ],
            'pay_method',
            'transaction_fee',
            'transaction_note:ntext',
            'note:ntext',
        ],
    ]) ?>

</div>
