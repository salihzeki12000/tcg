<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FormCardSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-card-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'card_type') ?>

    <?= $form->field($model, 'client_name') ?>

    <?= $form->field($model, 'name_on_card') ?>

    <?= $form->field($model, 'card_number') ?>

    <?php // echo $form->field($model, 'card_security_code') ?>

    <?php // echo $form->field($model, 'expiry_month') ?>

    <?php // echo $form->field($model, 'expiry_year') ?>

    <?php // echo $form->field($model, 'amount_to_bill') ?>

    <?php // echo $form->field($model, 'billing_address') ?>

    <?php // echo $form->field($model, 'contact_phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'card_holder_email') ?>

    <?php // echo $form->field($model, 'travel_agent') ?>

    <?php // echo $form->field($model, 'tour_date') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
