<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaFeedbackSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-feedback-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tour_id') ?>

    <?= $form->field($model, 'language') ?>

    <?= $form->field($model, 'create_time') ?>

    <?= $form->field($model, 'comment_itinerary') ?>

    <?php // echo $form->field($model, 'comment_meals') ?>

    <?php // echo $form->field($model, 'comment_service') ?>

    <?php // echo $form->field($model, 'why_chose_us') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'suggestions') ?>

    <?php // echo $form->field($model, 'client_name') ?>

    <?php // echo $form->field($model, 'client_email') ?>

    <?php // echo $form->field($model, 'agent') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
