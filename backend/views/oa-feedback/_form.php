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

    <?= $form->field($model, 'agent')->dropDownList(\common\models\Tools::getFormTravelAgents(), ['prompt' => '', 'disabled' => true])->label("Agent") ?>

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true, 'disabled' => true])->label("Client's name") ?>

    <?= $form->field($model, 'client_email')->textInput(['maxlength' => true, 'disabled' => true])->label("Client's email") ?>

    <?= $form->field($model, 'language')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_language'), ['disabled' => true]) ?>

    <?= $form->field($model, 'comment_itinerary')->textarea(['rows' => 6, 'disabled' => true])->label("Comment itinerary") ?>

    <?= $form->field($model, 'comment_meals')->textarea(['rows' => 6, 'disabled' => true])->label("Comment meals") ?>

    <?= $form->field($model, 'comment_service_agent')->textarea(['rows' => 6, 'disabled' => true])->label("Comment service agent") ?>

    <?= $form->field($model, 'comment_service_guide_driver')->textarea(['rows' => 6, 'disabled' => true])->label("Comment service guide & driver") ?>

    <?= $form->field($model, 'why_chose_us')->textInput(['maxlength' => true, 'disabled' => true])->label("Why client chose us") ?>

    <?= $form->field($model, 'rate')->dropDownList(['Excellent' => Yii::t('app','Excellent'), 'Very Good' => Yii::t('app','Very Good'), 'Average' => Yii::t('app','Average'), 'Poor' => Yii::t('app','Poor')], ['prompt' => Yii::t('app',''), 'disabled' => true])->label("Rate") ?>

    <?= $form->field($model, 'suggestions')->textarea(['rows' => 6, 'disabled' => true])->label("Suggestions") ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
