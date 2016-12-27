<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExchangeUsdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Exchange USD');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-usd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!-- <?//= Html::a(Yii::t('app', 'Create Exchange Usd'), ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'rate',
            'update_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['exchange-usd/view', 'id'=>$model->code]);
                    }
                    if ($action === 'update') {
                        return Url::to(['exchange-usd/update', 'id'=>$model->code]);
                    }
                },
            ],
],
    ]); ?>
</div>
