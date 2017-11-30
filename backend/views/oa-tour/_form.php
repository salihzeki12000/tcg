<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaTour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-tour-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inquiry_id')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'inquiry_source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vip')->textInput() ?>

    <?= $form->field($model, 'agent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'co-agent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'operator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_type')->textInput() ?>

    <?= $form->field($model, 'group_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organization')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'number_of_travelers')->textInput() ?>

    <?= $form->field($model, 'traveler_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tour_start_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_end_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_contact_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'itinerary_quotation_english')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'itinerary_quotation_other_language')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tour_schedule_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note_for_guide')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tour_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stage')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
