<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaGuideExpenseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-guide-expense-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tour_id') ?>

    <?= $form->field($model, 'guide_id') ?>

    <?= $form->field($model, 'start_date') ?>

    <?= $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'guide_service_fee') ?>

    <?php // echo $form->field($model, 'amount_spendings') ?>

    <?php // echo $form->field($model, 'details_spendings') ?>

    <?php // echo $form->field($model, 'cash_collect') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
