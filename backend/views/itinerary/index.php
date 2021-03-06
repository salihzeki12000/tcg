<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ItinerarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Itineraries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itinerary-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= (Yii::$app->language != Yii::$app->sourceLanguage) ? '' : Html::a(Yii::t('app', 'Create Itinerary'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tour_id',
            'day',
            'cities_name',
            // 'description:ntext',
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
