<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OaVoucher */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vouchers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-voucher-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
        <?php if($permission['isAdmin']): ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tour_id',
            'code',
            'value',
            [
				'attribute'=>'used',
				'value' => ($model->used) ? 'Yes' : 'No',
            ],
        ],
    ]) ?>

</div>
