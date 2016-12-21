<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'arrival_date') ?>

    <?= $form->field($model, 'arrival_city') ?>

    <?= $form->field($model, 'departure_date') ?>

    <?= $form->field($model, 'departure_city') ?>

    <?php // echo $form->field($model, 'adults') ?>

    <?php // echo $form->field($model, 'children') ?>

    <?php // echo $form->field($model, 'infants') ?>

    <?php // echo $form->field($model, 'guest_information') ?>

    <?php // echo $form->field($model, 'group_type') ?>

    <?php // echo $form->field($model, 'cities_plan') ?>

    <?php // echo $form->field($model, 'travel_interests') ?>

    <?php // echo $form->field($model, 'prefered_budget') ?>

    <?php // echo $form->field($model, 'additional_information') ?>

    <?php // echo $form->field($model, 'name_prefix') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'prefered_travel_agent') ?>

    <?php // echo $form->field($model, 'tour_code') ?>

    <?php // echo $form->field($model, 'tour_name') ?>

    <?php // echo $form->field($model, 'book_hotels') ?>

    <?php // echo $form->field($model, 'hotel_preferences') ?>

    <?php // echo $form->field($model, 'room_requirements') ?>

    <?php // echo $form->field($model, 'subject_program') ?>

    <?php // echo $form->field($model, 'participants_number') ?>

    <?php // echo $form->field($model, 'ideas') ?>

    <?php // echo $form->field($model, 'school_name') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'hear_about_us') ?>

    <?php // echo $form->field($model, 'purpose_trip') ?>

    <?php // echo $form->field($model, 'number_participants') ?>

    <?php // echo $form->field($model, 'ideas_trip') ?>

    <?php // echo $form->field($model, 'company_name') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
