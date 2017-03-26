<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= (Yii::$app->language != Yii::$app->sourceLanguage) ? '' : Html::a(Yii::t('app', 'Create Cities'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
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
            // [
            //     'attribute' => 'image',
            //     'format' => 'html',    
            //     'value' => function ($data) {
            //         return Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($data['pic_s'], 's'),
            //             ['width' => '70px']);
            //      },
            // ],
            'priority',
            // 'introduction:ntext',
            // 'food:ntext',
            // 'rec_type',
            // 'vr',
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
