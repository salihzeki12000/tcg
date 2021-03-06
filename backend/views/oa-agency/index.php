<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaAgencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Agencies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-agency-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Agency'), ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'rating',
            'create_time',
            // 'contact_person_info:ntext',
            // 'bank_info:ntext',
            // 'note:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
