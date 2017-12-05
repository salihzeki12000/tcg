<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\OaTour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-tour-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inquiry_id')->textInput(['readonly' => !$model->isNewRecord]) ?>

    <?php if (!$model->isNewRecord) { ?>

    <?= $form->field($model, 'inquiry_source')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_inquiry_source')) ?>

    <?= $form->field($model, 'language')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_language')) ?>

    <?= $form->field($model, 'vip')->dropdownList(Yii::$app->params['yes_or_no']) ?>

    <?= $form->field($model, 'agent')->dropdownList(common\models\Tools::getUserList()) ?>

    <?= $form->field($model, 'co_agent')->dropdownList(common\models\Tools::getUserList()) ?>

    <?= $form->field($model, 'operator')->dropdownList(common\models\Tools::getUserList()) ?>

    <?= $form->field($model, 'tour_type')->dropdownList(Yii::$app->params['form_types']) ?>

    <?= $form->field($model, 'group_type')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_group_type')) ?>

    <?= $form->field($model, 'country')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_country')) ?>

    <?= $form->field($model, 'organization')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'number_of_travelers')->textInput() ?>

    <?= $form->field($model, 'traveler_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tour_start_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_end_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities')->checkboxList(ArrayHelper::map(common\models\OaCity::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_contact_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'itinerary_quotation_english')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'itinerary_quotation_other_language')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tour_schedule_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note_for_guide')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tour_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment')->dropdownList(['Unpaid'=>'Unpaid','Deposit Paid'=>'Deposit Paid','Fully Paid'=>'Fully Paid']) ?>

    <?= $form->field($model, 'stage')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_tour_stage')) ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Next') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['backend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['backend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#oatour-tour_start_date, #oatour-tour_end_date").attr("readonly","readonly").datepicker({ format: 'yyyy-mm-dd' });
    });
JS;
$this->registerJs($js);
?>