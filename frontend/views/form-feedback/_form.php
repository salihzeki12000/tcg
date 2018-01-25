<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-feedback-form">
	<hr />
    <?php $form = ActiveForm::begin(['id'=>'form-feedback-form']) ?>
   
    <?= $form->field($model, 'comment_itinerary')->textarea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'comment_meals')->textarea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'comment_service_agent')->textarea(['maxlength' => true, 'placeholder' => Yii::t('app', 'Your travel agent is your contact at The China Guide who organized your tour'), 'rows' => '3']) ?>

    <?= $form->field($model, 'comment_service_guide_driver')->textarea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'why_chose_us')->textarea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'rate')->dropDownList(['Excellent' => Yii::t('app','Excellent'), 'Very Good' => Yii::t('app','Very Good'), 'Average' => Yii::t('app','Average'), 'Poor' => Yii::t('app','Poor')], ['prompt' => Yii::t('app','')]) ?>

    <?= $form->field($model, 'suggestions')->textarea(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'client_name')->textinput(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'client_email')->textinput(['maxlength' => true, 'rows' => '3']) ?>

    <?= $form->field($model, 'agent')->dropDownList(\common\models\Tools::getFormTravelAgents(), ['prompt' => '']) ?>
    
    <div class="form-group bt-submit">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>