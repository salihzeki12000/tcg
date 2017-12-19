<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tour_id')->textInput()?>

    <?= $form->field($model, 'agent')->dropDownList(\common\models\Tools::getFormTravelAgents(), ['prompt' => ''])->label("Agent") ?>

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true])->label("Client's name") ?>

    <?= $form->field($model, 'client_email')->textInput(['maxlength' => true])->label("Client's email") ?>

    <?= $form->field($model, 'language')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_language')) ?>

    <?//= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'comment_itinerary')->textarea(['rows' => 6])->label("Comment itinerary") ?>

    <?= $form->field($model, 'comment_meals')->textarea(['rows' => 6])->label("Comment meals") ?>

    <?= $form->field($model, 'comment_service')->textarea(['rows' => 6])->label("Comment service") ?>

    <?= $form->field($model, 'how_found_us')->textInput(['maxlength' => true])->label("How client found us") ?>

    <?= $form->field($model, 'why_chose_us')->textInput(['maxlength' => true])->label("Why client chose us") ?>

    <?= $form->field($model, 'rate')->dropDownList(['Excellent' => Yii::t('app','Excellent'), 'Very Good' => Yii::t('app','Very Good'), 'Average' => Yii::t('app','Average'), 'Poor' => Yii::t('app','Poor')], ['prompt' => Yii::t('app','')])->label("Rate") ?>

    <?= $form->field($model, 'suggestions')->textarea(['rows' => 6])->label("Suggestions") ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
