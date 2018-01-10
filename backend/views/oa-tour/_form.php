<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\OaTour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-tour-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'inquiry_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'inquiry_source')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_inquiry_source'), ['prompt' => '--Select--', 'disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'language')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_language'), ['prompt' => '--Select--', 'disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'agent')->dropdownList(common\models\Tools::getAgentUserList(), ['prompt' => '--Select--', 'disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'co_agent')->dropdownList(common\models\Tools::getAgentUserList(), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'operator')->dropdownList(common\models\Tools::getAgentUserList(), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'stage')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_tour_stage')) ?>

    <?= $form->field($model, 'tour_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estimated_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment')->dropdownList(['Unpaid'=>'Unpaid','Deposit Paid'=>'Deposit Paid','Fully Paid'=>'Fully Paid'], ['prompt' => '--Select--', 'disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'accounting_sales_amount')->textInput(['maxlength' => true, 'disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'accounting_total_cost')->textInput(['maxlength' => true, 'disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'accounting_hotel_flight_train_cost')->textInput(['maxlength' => true,'disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'close')->dropdownList(Yii::$app->params['yes_or_no'], ['disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?php
        $form_types = Yii::$app->params['form_types'];
        unset($form_types[1]);
    ?>
    
    <?= $form->field($model, 'tour_type')->dropdownList($form_types, ['prompt' => '--Select--']) ?>
    
    <?= $form->field($model, 'organization')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '100px',
        'replaceDivs' => false,
        'buttons' => []
        ],
    ]) ?>

    <?= $form->field($model, 'vip')->dropdownList(Yii::$app->params['yes_or_no']) ?>

    <?= $form->field($model, 'tour_start_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_end_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities')->checkboxList(ArrayHelper::map(common\models\OaCity::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'number_of_travelers')->textInput() ?>

    <?= $form->field($model, 'traveler_info')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '100px',
        'replaceDivs' => false,
        'buttons' => []
        ],
    ]) ?>

    <?= $form->field($model, 'group_type')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_group_type'), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'country')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_country'), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_contact_info')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '100px',
        'replaceDivs' => false,
        'buttons' => []
        ],
    ]) ?>

    <?= $form->field($model, 'itinerary_quotation_english')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'itinerary_quotation_other_language')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'task_remind')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'task_remind_date', [
        'template' => '{label} &nbsp;&nbsp;&nbsp;(<a class="bt_clear_item" href="javascript:void(0);">Clear</a>) {input}{error}{hint}'
    ]) ?>

    <?= $form->field($model, 'tour_schedule_note')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'note_for_guide')->widget(\yii\redactor\widgets\Redactor::className(), [
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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['backend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['backend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#oatour-tour_start_date, #oatour-tour_end_date, #oatour-task_remind_date").attr("readonly","readonly").datepicker({ format: 'yyyy-mm-dd' });
        $(".bt_clear_item").click(function(){
            $(this).next().val("");
        });
    });
JS;
$this->registerJs($js);
?>