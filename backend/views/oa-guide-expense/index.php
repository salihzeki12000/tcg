<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaGuideExpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oa Guide Expenses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-guide-expense-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Oa Guide Expense'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tour_id',
            'guide_id',
            'start_date',
            'end_date',
            // 'guide_service_fee',
            // 'amount_spendings',
            // 'details_spendings:ntext',
            // 'cash_collect:ntext',
            // 'notes:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
