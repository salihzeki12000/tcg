<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FormInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inquiries');
$this->params['breadcrumbs'][] = $this->title;

$action_template = [];
$action_template[] = '{view}';
if (!in_array(Yii::$app->user->identity->id, [6])) {
    $action_template[] = '{delete}';
}
?>
<div class="form-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            // 'type',
            [
                'attribute'=>'type',
                'filter'=> Yii::$app->params['form_types'],
                'value' => function ($data) {
                    return Yii::$app->params['form_types'][$data['type']];
                }
            ],
            'prefered_travel_agent',
            'tour_code',
            // 'adults',
            [
                'attribute'=>'Guests',
                'value' => function ($data) {
                    if($data['type'] == FORM_TYPE_EDU)
                        return $data['participants_number'];
                    else
                        return $data['adults'];
                }
            ],
            'arrival_date',
            'name',
            // [
            //     'attribute'=>'Title',
            //     'value' => function ($data) {
            //         $title =  Yii::$app->params['form_types'][$data['type']]
            //         . ($data['prefered_travel_agent']?"-{$data['prefered_travel_agent']}":"")
            //         . ($data['tour_code']?"-{$data['tour_code']}":"")
            //         . ($data['tour_length']?"-{$data['tour_length']} Days":"")
            //         . ($data['adults']?"-{$data['adults']} Guests":'')
            //         . ($data['participants_number']?"-{$data['participants_number']} Guests":'')
            //         . ($data['arrival_date']?"-{$data['arrival_date']}":'')
            //         . ($data['name']?"-{$data['name']}":'');

            //         return $title;
            //     }
            // ],
            //'arrival_city',
            // 'departure_date',
            // 'departure_city',
            // 'children',
            // 'infants',
            // 'guest_information',
            // 'group_type',
            // 'cities_plan',
            // 'travel_interests',
            // 'prefered_budget',
            // 'additional_information',
            // 'name_prefix',
            // 'email:email',
            // 'nationality',
            // 'tour_name',
            // 'book_hotels',
            // 'hotel_preferences',
            // 'room_requirements',
            // 'subject_program',
            // 'participants_number',
            // 'ideas',
            // 'school_name',
            // 'position',
            // 'phone_number',
            // 'hear_about_us',
            // 'purpose_trip',
            // 'number_participants',
            // 'ideas_trip',
            // 'company_name',
            'create_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => join(' ', $action_template),
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['form-info/view', 'id'=>$model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['form-info/delete', 'id'=>$model->id]);
                    }
                },
            ],
        ],
    ]); ?>
</div>
