<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaBookCostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-book-cost-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tour_id') ?>

    <?= $form->field($model, 'create_time') ?>

    <?= $form->field($model, 'updat_time') ?>

    <?= $form->field($model, 'creator') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'fid') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'cl_info') ?>

    <?php // echo $form->field($model, 'need_to_pay') ?>

    <?php // echo $form->field($model, 'cny_amount') ?>

    <?php // echo $form->field($model, 'due_date_for_pay') ?>

    <?php // echo $form->field($model, 'pay_status') ?>

    <?php // echo $form->field($model, 'pay_date') ?>

    <?php // echo $form->field($model, 'pay_amount') ?>

    <?php // echo $form->field($model, 'transaction_note') ?>

    <?php // echo $form->field($model, 'book_status') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
