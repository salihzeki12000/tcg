<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tour_id')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'payer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cny_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'due_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receit_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receit_cny_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receit_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cc_note_signing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
