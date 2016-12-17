<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'arrival_date',
            'arrival_city',
            'departure_date',
            'departure_city',
            'adults',
            'children',
            'infants',
            'guest_information',
            'group_type',
            'cities_plan',
            'travel_interests',
            'prefered_budget',
            'additional_information',
            'name_prefix',
            'name',
            'email:email',
            'nationality',
            'prefered_travel_agent',
            'tour_code',
            'tour_name',
            'book_hotels',
            'hotel_preferences',
            'room_requirements',
            'subject_program',
            'participants_number',
            'ideas',
            'school_name',
            'position',
            'phone_number',
            'hear_about_us',
            'purpose_trip',
            'number_participants',
            'company_name',
        ],
    ]) ?>

</div>
