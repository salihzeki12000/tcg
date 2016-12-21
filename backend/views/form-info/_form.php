<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'arrival_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'arrival_city')->dropDownList([ 'Beijing' => 'Beijing', 'Shanghai' => 'Shanghai', 'Guangzhou' => 'Guangzhou', 'Hongkong' => 'Hongkong', 'Other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'departure_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departure_city')->dropDownList([ 'Beijing' => 'Beijing', 'Shanghai' => 'Shanghai', 'Guangzhou' => 'Guangzhou', 'Hongkong' => 'Hongkong', 'Other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'adults')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18', 19 => '19', 20 => '20', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'children')->dropDownList([ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'infants')->dropDownList([ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'guest_information')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_type')->dropDownList([ 'Family' => 'Family', 'Couple' => 'Couple', 'Friends' => 'Friends', 'Business' => 'Business', 'Solo' => 'Solo', 'Other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'cities_plan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travel_interests')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prefered_budget')->dropDownList([ 'Below 1499 USD' => 'Below 1499 USD', '1500 to 2999 USD' => '1500 to 2999 USD', '3000 to 4999 USD' => '3000 to 4999 USD', 'Above 5000 USD' => 'Above 5000 USD', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'additional_information')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_prefix')->dropDownList([ 'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Miss' => 'Miss', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prefered_travel_agent')->dropDownList([ 'English' => 'English', 'Français' => 'Français', 'Español' => 'Español', 'Deutsch' => 'Deutsch', '中文' => '中文', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tour_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_hotels')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'hotel_preferences')->dropDownList([ '3 star or equal' => '3 star or equal', '4 star or equal' => '4 star or equal', '5 star or equal' => '5 star or equal', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'room_requirements')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'participants_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ideas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hear_about_us')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purpose_trip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_participants')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ideas_trip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
