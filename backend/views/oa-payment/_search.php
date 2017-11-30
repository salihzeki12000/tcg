<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaPaymentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-payment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tour_id') ?>

    <?= $form->field($model, 'create_time') ?>

    <?= $form->field($model, 'update_time') ?>

    <?= $form->field($model, 'payer') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'cny_amount') ?>

    <?php // echo $form->field($model, 'due_date') ?>

    <?php // echo $form->field($model, 'pay_method') ?>

    <?php // echo $form->field($model, 'receit_account') ?>

    <?php // echo $form->field($model, 'receit_cny_amount') ?>

    <?php // echo $form->field($model, 'transaction_fee') ?>

    <?php // echo $form->field($model, 'receit_date') ?>

    <?php // echo $form->field($model, 'cc_note_signing') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
