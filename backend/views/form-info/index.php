<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FormInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Form Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Form Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'arrival_date',
            'arrival_city',
            'departure_date',
            'departure_city',
            // 'adults',
            // 'children',
            // 'infants',
            // 'guest_information',
            // 'group_type',
            // 'cities_plan',
            // 'travel_interests',
            // 'prefered_budget',
            // 'additional_information',
            // 'name_prefix',
            // 'name',
            // 'email:email',
            // 'nationality',
            // 'prefered_travel_agent',
            // 'tour_code',
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
            // 'type',
            // 'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
