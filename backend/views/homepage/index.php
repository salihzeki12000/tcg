<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HomepageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', ucfirst(Yii::$app->controller->id));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homepage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->language == Yii::$app->sourceLanguage) { ?>
        <p>
            <?= (Yii::$app->language != Yii::$app->sourceLanguage) ? '' : Html::a(Yii::t('app', 'Create ' . ucfirst(Yii::$app->controller->id)), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
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
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($data['pic_s'], 's'),
                        ['width' => '70px']);
                 },
            ],
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
