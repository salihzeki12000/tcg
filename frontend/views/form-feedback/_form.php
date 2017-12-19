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
   
    <?= $form->field($model, 'comment_itinerary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment_meals')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agent')->dropDownList(\common\models\Tools::getFormTravelAgents(), ['prompt' => '']) ?>

    <?= $form->field($model, 'comment_service')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Your travel agent is your contact at The China Guide who organized your tour')]) ?>

    <?= $form->field($model, 'how_found_us')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'why_chose_us')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate')->dropDownList(['Excellent' => Yii::t('app','Excellent'), 'Very Good' => Yii::t('app','Very Good'), 'Average' => Yii::t('app','Average'), 'Poor' => Yii::t('app','Poor')], ['prompt' => Yii::t('app','')]) ?>

    <?= $form->field($model, 'suggestions')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_email')->textInput(['maxlength' => true]) ?>

    <div class="form-group bt-submit">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>