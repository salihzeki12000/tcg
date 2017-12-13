<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oa Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= true ? '' : Html::a(Yii::t('app', 'Create Oa Payment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tour_id',
            'create_time',
            'update_time',
            'payer',
            // 'type',
            // 'cny_amount',
            // 'due_date',
            // 'pay_method',
            // 'receit_account',
            // 'receit_cny_amount',
            // 'transaction_fee',
            // 'receit_date',
            // 'cc_note_signing',
            // 'note:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['oa-payment/view', 'id'=>$model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['oa-payment/delete', 'id'=>$model->id]);
                    }
                },
            ],
        ],
    ]); ?>
</div>
