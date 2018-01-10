<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaHotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hotels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-hotel-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Hotel'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute'=>'city_id',
                'filter'=>ArrayHelper::map(\common\models\OaCity::find()->asArray()->all(), 'id', 'name'),
                'value' => function ($data) {
                    return \common\models\OaCity::findOne($data['city_id'])->name;
                }
            ],
            'level',
            // 'tripadvisor_link',
            // 'rating',
            // 'rooms_prices:ntext',
            // 'contact_person_info:ntext',
            // 'bank_info:ntext',
            // 'cl_english:ntext',
            // 'note:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
