<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\OaHotel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-hotel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->dropdownList(ArrayHelper::map(common\models\OaCity::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'level')->radioList(['3'=>'3*','4'=>'4*','5'=>'5*']) ?>

    <?= $form->field($model, 'tripadvisor_link')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'rating')->radioList(['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5']) ?>

    <?= $form->field($model, 'rooms_prices')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_person_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bank_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cl_english')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
