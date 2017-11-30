<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\OaInquiry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-inquiry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inquiry_source')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_inquiry_source')) ?>

    <?= $form->field($model, 'language')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_language')) ?>

    <?= $form->field($model, 'priority')->dropdownList(['Normal'=>'Normal', 'High'=>'High']) ?>

    <?= $form->field($model, 'agent')->dropdownList(common\models\Tools::getUserList()) ?>

    <?= $form->field($model, 'co_agent')->dropdownList(common\models\Tools::getUserList()) ?>

    <?= $form->field($model, 'tour_type')->dropdownList(Yii::$app->params['form_types']) ?>

    <?= $form->field($model, 'group_type')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_group_type')) ?>

    <?= $form->field($model, 'organization')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_country')) ?>

    <?= $form->field($model, 'number_of_travelers')->textInput() ?>

    <?= $form->field($model, 'traveler_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tour_start_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_end_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities')->checkboxList(ArrayHelper::map(common\models\OaCity::find()->all(), 'name', 'name')) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_contact_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'original_inquiry')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'follow_up_record')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tour_schedule_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estimated_cny_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'probability')->dropdownList(['Normal'=>'Normal', 'High'=>'High']) ?>

    <?= $form->field($model, 'inquiry_status')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_inquiry_status')) ?>

    <?= $form->field($model, 'close')->dropdownList(Yii::$app->params['yes_or_no']) ?>

    <?= $form->field($model, 'close_report')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
