<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\OaInquiry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-inquiry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inquiry_source')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_inquiry_source'), ['disabled' => !$permission['canAdd']]) ?>

    <?= $form->field($model, 'language')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_language'), ['disabled' => !$permission['canAdd']]) ?>

    <?= $form->field($model, 'priority')->dropdownList(['Normal'=>'Normal', 'High'=>'High']) ?>

    <?= $form->field($model, 'agent')->dropdownList(common\models\Tools::getUserList(), ['prompt' => '--Select--', 'disabled' => !$permission['canAdd']]) ?>

    <?= $form->field($model, 'co_agent')->dropdownList(common\models\Tools::getUserList(), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'tour_type')->dropdownList(Yii::$app->params['form_types']) ?>

    <?= $form->field($model, 'group_type')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_group_type')) ?>

    <?= $form->field($model, 'organization')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'country')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_country'), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'number_of_travelers')->textInput() ?>

    <?= $form->field($model, 'traveler_info')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'tour_start_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_end_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities')->checkboxList(ArrayHelper::map(common\models\OaCity::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_contact_info')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?php if ($permission['canAdd']) { ?>
        <?= $form->field($model, 'original_inquiry')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'minHeight' => '250px',
            'replaceDivs' => false,
            'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
            ],
        ]) ?>
    <?php } else { ?>
        <div class="form-group field-oainquiry-original_inquiry">
            <label class="control-label" for="oainquiry-original_inquiry">Original Inquiry</label>
            <?= $model->original_inquiry?>
        </div>
    <?php } ?>

    <?= $form->field($model, 'follow_up_record')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'tour_schedule_note')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'other_note')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'estimated_cny_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'probability')->dropdownList(['Normal'=>'Normal', 'High'=>'High']) ?>

    <?= $form->field($model, 'inquiry_status')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_inquiry_status')) ?>

    <?= $form->field($model, 'close')->dropdownList(Yii::$app->params['yes_or_no']) ?>

    <?= $form->field($model, 'close_report')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['backend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['backend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#oainquiry-tour_start_date, #oainquiry-tour_end_date").datepicker({ format: 'yyyy-mm-dd' });
    });
JS;
$this->registerJs($js);
?>