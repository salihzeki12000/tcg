<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaTourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oa Tours');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-tour-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Oa Tour'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'inquiry_id',
            'create_time',
            'update_time',
            'inquiry_source',
            // 'language',
            // 'vip',
            // 'agent',
            // 'co_agent',
            // 'operator',
            // 'tour_type',
            // 'group_type',
            // 'country',
            // 'organization:ntext',
            // 'number_of_travelers',
            // 'traveler_info:ntext',
            // 'tour_start_date',
            // 'tour_end_date',
            [
                'attribute'=>'cities',
                'filter'=>ArrayHelper::map(\common\models\OaCity::find()->asArray()->all(), 'id', 'name'),
                'value' => function ($data) {
                    $cities = ArrayHelper::map(\common\models\OaCity::find()->where(['id' => explode(',', $data['cities'])])->all(), 'id', 'name');
                    $show_cities = join(',', array_values($cities));
                    if (strlen($show_cities)>30) {
                        $show_cities = substr($show_cities,0, 30) . '...';
                    }
                    return $show_cities;
                }
            ],
            // 'contact',
            // 'email:email',
            // 'other_contact_info:ntext',
            // 'itinerary_quotation_english:ntext',
            // 'itinerary_quotation_other_language:ntext',
            // 'tour_schedule_note:ntext',
            // 'note_for_guide:ntext',
            // 'other_note:ntext',
            // 'tour_price',
            // 'payment',
            // 'stage',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
