<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payments');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$addon = <<< HTML
<span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
HTML;
?>

<div class="oa-payment-index">

    <p>
        <?= true ? '' : Html::a(Yii::t('app', 'Create Payment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'showFooter' => true,
        'columns' => [
            [
				'label'=>'ID',
				'attribute'=>'id',
				'format' => 'raw',
				'value' => function($model) {
					return '<a href="' . Url::to(['oa-payment/view', 'id'=>$model['id']]) . '" target="_blank">P' . $model['id'] . '</a>';
				},
				'footer' => 'Total'
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
				'label' => 'Tour Start',
				'attribute' => 'tour_start_date',
				'headerOptions' => ['width' => '200'],
            ],
            [
                'attribute'=>'payer_type',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_payer_type'),
                'value' => function ($data) {
	                $types = \common\models\Tools::getEnvironmentVariable('oa_payer_type');
                    return (!empty($data['payer_type'])) ? $types[$data['payer_type']] : '';
                },
				'headerOptions' => ['width' => '100'],
            ],
            'payer',
            [
                'attribute'=>'type',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_pay_type'),
                'value' => function ($data) {
                    return $data['type'];
                }
            ],
            [
				'label'=>'Amount',
				'attribute'=>'cny_amount',
				'footer' => \common\models\Tools::getTotal($dataProvider->models, 'cny_amount'),
            ],
            'due_date',
            [
                'attribute'=>'status',
                'label'=>'Status',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_pay_status'),
                'format' => 'raw',
                'value' => function ($data) {
	                $notPaid = 'Not Paid';
	                $paid = 'Paid';
	                $note = '';
	                $transactionNote = '';
                	
                	if(!empty(htmlspecialchars($data["transaction_note"]))):
						$transactionNote = 'Transaction Note: '.htmlspecialchars($data["transaction_note"]).'<br><br>';
                	endif;
	                
                	if(!empty(htmlspecialchars($data["note"]))):
                		$note = 'Note: '.htmlspecialchars($data["note"]);
                	endif;
	                	
	                if(!empty($note) || !empty($transactionNote)):
	                	return $data['status'] == 0 ? '<a tabindex="0" data-html="true" data-placement="left" data-toggle="popover" data-trigger="focus" title="Notes" data-content="'.$transactionNote.$note.'" style="text-decoration: underline; cursor:pointer;">'.$notPaid.'</a>' : '<a tabindex="0" data-html="true" data-placement="left" data-toggle="popover" data-trigger="focus" title="Notes" data-content="'.$transactionNote.$note.'" style="text-decoration: underline; cursor:pointer;">'.$paid.'</a>';
	  	            endif;
	  	            
                    return $data['status'] == 0 ? $notPaid : $paid;
                }
            ],
            [
				'label'=>'Confirmed Amount',
				'attribute'=>'confirmed_amount',
				'footer' => \common\models\Tools::getTotal($dataProvider->models, 'confirmed_amount'),
            ],
            [
				'label'=>'Accounting Amount',
				'attribute'=>'receit_cny_amount',
				'footer' => \common\models\Tools::getTotal($dataProvider->models, 'receit_cny_amount'),
            ],
            [
				'label'=>'Accounting Date',
				'attribute'=>'receit_date',
            ],
            [
                'attribute' => 'pay_method',
                'label'=>'Method',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_pay_method'),
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

<?php
$js = <<<JS
	/* To initialize BS3 popovers set this below */
	$(function () { 
	    $("[data-toggle='popover']").popover(); 
	});
JS;
$this->registerJs($js);
?>