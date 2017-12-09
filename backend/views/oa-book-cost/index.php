<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaBookCostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oa Book Costs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-book-cost-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Oa Book Cost'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tour_id',
            [
                'attribute'=>'type',
                'filter'=> Yii::$app->params['oa_book_cost_type'],
                'value' => function ($data) {
                    return Yii::$app->params['oa_book_cost_type'][$data['type']];
                }
            ],
            'create_time',
            'updat_time',
            // 'creator',
            // 'fid',
            // 'start_date',
            // 'end_date',
            // 'cl_info:ntext',
            // 'need_to_pay',
            // 'cny_amount',
            // 'due_date_for_pay',
            // 'pay_status',
            // 'pay_date',
            // 'pay_amount',
            // 'transaction_note:ntext',
            // 'book_status',
            // 'note:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
