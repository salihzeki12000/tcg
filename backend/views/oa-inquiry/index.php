<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaInquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oa Inquiries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-inquiry-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Oa Inquiry'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'create_time',
            'update_time',
            'inquiry_source',
            // 'language',
            // 'priority',
            // 'agent',
            // 'co_agent',
            // 'tour_type',
            // 'group_type',
            // 'organization:ntext',
            // 'country',
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
            // 'original_inquiry:ntext',
            // 'follow_up_record:ntext',
            // 'tour_schedule_note:ntext',
            // 'other_note:ntext',
            // 'estimated_cny_amount',
            // 'probability',
            // 'inquiry_status',
            // 'close',
            // 'close_report:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
