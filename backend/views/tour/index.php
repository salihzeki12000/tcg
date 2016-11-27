<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Cities;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tours');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tour'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'code',
            [
                'attribute'=>'status',
                'filter'=> Yii::$app->params['dis_status'],
                'value' => function ($data) {
                    return Yii::$app->params['dis_status'][$data['status']];
                }
            ],
            // 'themes',
            [
                'attribute'=>'cities',
                'filter'=>ArrayHelper::map(Cities::find()->asArray()->all(), 'id', 'name'),
                'value' => function ($data) {
                    $cities = ArrayHelper::map(Cities::find()->where(['id' => explode(',', $data['cities'])])->all(), 'id', 'name');
                    return join(',', array_values($cities));
                }
            ],
            [
                'attribute'=>'rec_type',
                'filter'=>Yii::$app->params['rec_type'],
                'value' => function ($data) {
                    $arr_data = [];
                    if (!empty($data['rec_type'])) {
                        foreach (explode(',', $data['rec_type']) as $value) {
                            $arr_data[$value] = Yii::$app->params['rec_type'][$value];
                        }
                    }
                    return join(',', array_values($arr_data));
                }
            ],
            // 'cities_count',
            // 'priority',
            // 'tour_length',
            // 'exp_num',
            // 'price_cny',
            // 'price_usd',
            // 'overview:ntext',
            // 'best_season',
            // 'pic_map',
            // 'pic_title',
            // 'inclusion:ntext',
            // 'exclusion:ntext',
            // 'tips:ntext',
            // 'keywords',
            // 'link_tour',
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
