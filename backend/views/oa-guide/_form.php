<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\OaGuide */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-guide-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->dropdownList(common\models\Tools::getUserList()) ?>

    <?= $form->field($model, 'rating')->radioList(['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5']) ?>

    <?= $form->field($model, 'language')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_language')) ?>

    <?= $form->field($model, 'daily_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->dropdownList(ArrayHelper::map(common\models\OaCity::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'agency')->dropdownList(ArrayHelper::map(common\models\OaAgency::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'contact_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'identity_bank_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cl_english')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
