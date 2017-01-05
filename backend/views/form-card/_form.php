<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FormCard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-card-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'card_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_on_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_security_code')->textInput() ?>

    <?= $form->field($model, 'expiry_month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expiry_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_to_bill')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billing_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_holder_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travel_agent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
