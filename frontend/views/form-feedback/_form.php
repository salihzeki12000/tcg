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
   
    <?= $form->field($model, 'comment_itinerary', ['labelOptions' => ['style' => 'font-weight: normal', 'class' => 'control-label']])->textarea(['maxlength' => true, 'rows' => '2']) ?>

    <?= $form->field($model, 'comment_meals', ['labelOptions' => ['style' => 'font-weight: normal', 'class' => 'control-label']])->textarea(['maxlength' => true, 'rows' => '2']) ?>

    <?= $form->field($model, 'comment_service_guide_driver', ['labelOptions' => ['style' => 'font-weight: normal', 'class' => 'control-label']])->textarea(['maxlength' => true, 'rows' => '2']) ?>

    <?= $form->field($model, 'comment_service_agent', ['labelOptions' => ['style' => 'font-weight: normal', 'class' => 'control-label']])->textarea(['maxlength' => true, 'placeholder' => Yii::t('app', 'Your travel specialist is your contact at The China Guide who organized your tour.'), 'rows' => '2']) ?>

    <?= $form->field($model, 'rate', ['labelOptions' => ['style' => 'font-weight: normal', 'class' => 'control-label']])->dropDownList(['Excellent' => Yii::t('app','Excellent'), 'Very Good' => Yii::t('app','Very Good'), 'Average' => Yii::t('app','Average'), 'Poor' => Yii::t('app','Poor')], ['prompt' => Yii::t('app','')]) ?>

    <?= $form->field($model, 'why_chose_us', ['labelOptions' => ['style' => 'font-weight: normal', 'class' => 'control-label']])->textarea(['maxlength' => true, 'rows' => '2']) ?>

    <?= $form->field($model, 'suggestions', ['labelOptions' => ['style' => 'font-weight: normal', 'class' => 'control-label']])->textarea(['maxlength' => true, 'rows' => '2']) ?>
    
    <div class="form-group bt-submit">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>