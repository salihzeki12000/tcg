<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaVoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vouchers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-voucher-index">

	<?php if($permission['isAdmin']): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Voucher'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
				'label'=>'ID',
				'attribute'=>'id',
				'format' => 'raw',
				'value' => function($model) {
					return '<a href="' . Url::to(['oa-voucher/view', 'id'=>$model['id']]) . '" target="_blank">' . $model['id'] . '</a>';
				},
            ],
            'tour_id',
            'code',
            'value',
            [
				'attribute'=>'used',
				'value' => function($model) {
					return ($model->used) ? 'Yes' : 'No';
				},
            ],
        ],
    ]); ?>
</div>
