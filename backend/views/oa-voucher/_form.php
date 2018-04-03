<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaVoucher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-voucher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tour_id')->textInput(['readonly' => !$model->isNewRecord ? true : false]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord ? true : false]) ?>

    <?= $form->field($model, 'value')->textInput(['readonly' => !$model->isNewRecord ? true : false]) ?>

    <?= $form->field($model, 'used')->dropdownList(['1' => 'Yes', '0' => 'No'], ['prompt' => '--Select--']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
