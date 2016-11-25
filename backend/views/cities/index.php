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
        <?= Html::a(Yii::t('app', 'Create Cities'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'status',
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($data['pic_s'], 's'),
                        ['width' => '70px']);
                 },
            ],
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
