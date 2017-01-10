<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ThemeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Themes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= (Yii::$app->language != Yii::$app->sourceLanguage) ? '' : Html::a(Yii::t('app', 'Create Theme'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'name',
            // 'use_ids',
            'priority',
            [
                'attribute'=>'status',
                'filter'=> Yii::$app->params['dis_status'],
                'value' => function ($data) {
                    return Yii::$app->params['dis_status'][$data['status']];
                }
            ],
            // 'class_name',
            // 'create_time',
            // 'update_time',
            // 'sync_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
