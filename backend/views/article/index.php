<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', ucfirst(Yii::$app->controller->id));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= (Yii::$app->language != Yii::$app->sourceLanguage) ? '' : Html::a(Yii::t('app', 'Create ' . ucfirst(Yii::$app->controller->id)), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute'=>'Url Title',
                'value' => function ($data) {
                    return urlencode($data['title']);
                }
            ],
            // 'type',
            // 'sub_type',
            // 'content:ntext',
            [
                'attribute'=>'status',
                'filter'=> Yii::$app->params['dis_status'],
                'value' => function ($data) {
                    return Yii::$app->params['dis_status'][$data['status']];
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
            'priority',
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
