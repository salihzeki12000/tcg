<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Theme */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="theme-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'use_ids')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'priority')->dropdownList([0,1,2,3,4,5,6,7,8,9]) ?>

    <?= $form->field($model, 'status')->dropdownList(Yii::$app->params['dis_status']) ?>
    
    <?= $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>