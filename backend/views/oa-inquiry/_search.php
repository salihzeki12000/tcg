<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaInquirySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-inquiry-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_time') ?>

    <?= $form->field($model, 'update_time') ?>

    <?= $form->field($model, 'inquiry_source') ?>

    <?= $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'agent') ?>

    <?php // echo $form->field($model, 'co_agent') ?>

    <?php // echo $form->field($model, 'tour_type') ?>

    <?php // echo $form->field($model, 'group_type') ?>

    <?php // echo $form->field($model, 'organization') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'number_of_travelers') ?>

    <?php // echo $form->field($model, 'traveler_info') ?>

    <?php // echo $form->field($model, 'tour_start_date') ?>

    <?php // echo $form->field($model, 'tour_end_date') ?>

    <?php // echo $form->field($model, 'cities') ?>

    <?php // echo $form->field($model, 'contact') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'other_contact_info') ?>

    <?php // echo $form->field($model, 'original_inquiry') ?>

    <?php // echo $form->field($model, 'follow_up_record') ?>

    <?php // echo $form->field($model, 'tour_schedule_note') ?>

    <?php // echo $form->field($model, 'other_note') ?>

    <?php // echo $form->field($model, 'estimated_cny_amount') ?>

    <?php // echo $form->field($model, 'probability') ?>

    <?php // echo $form->field($model, 'inquiry_status') ?>

    <?php // echo $form->field($model, 'close') ?>

    <?php // echo $form->field($model, 'close_report') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
