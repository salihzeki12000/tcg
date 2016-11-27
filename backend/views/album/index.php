<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\UploadedFiles;
use common\models\Cities;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', ucfirst(Yii::$app->controller->id));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create '.ucfirst(Yii::$app->controller->id)), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'type',
            'name',
            [
                'attribute'=>'city_id',
                'filter'=>ArrayHelper::map(Cities::find()->asArray()->all(), 'id', 'name'),
                'value' => function ($data) {
                    return Cities::findOne($data['city_id'])->name;
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($data['pic_s'], 's'),
                        ['width' => '70px']);
                 },
            ],
            // 'pic_s',
            // 'overview:ntext',
            // 'rec_type',
            // 'status',
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
