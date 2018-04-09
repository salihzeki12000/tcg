<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\OaTour */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
$username = \Yii::$app->user->username;
?>

<div class="oa-tour-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'inquiry_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'inquiry_source')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_inquiry_source'), ['prompt' => '--Select--', 'disabled' => !$permission['isAdmin']]) ?>

    <?= $form->field($model, 'language', ['labelOptions' => ['class' => 'important-info']])->dropdownList(common\models\Tools::getEnvironmentVariable('oa_language'), ['prompt' => '--Select--', 'disabled' => !$permission['isAdmin']]) ?>

    <?= $form->field($model, 'agent', ['labelOptions' => ['class' => 'important-info']])->dropdownList(common\models\Tools::getAgentUserList(), ['prompt' => '--Select--', 'disabled' => !$permission['isAdmin']]) ?>
	<?php if(!$permission['isAdmin']): ?>
		<div class="hide">
			<?= $form->field($model, 'inquiry_source')->hiddenInput()->label(''); ?>
			<?= $form->field($model, 'language')->hiddenInput()->label(''); ?>
			<?= $form->field($model, 'agent')->hiddenInput()->label(''); ?>
		</div>
	<?php endif; ?>
	
	<?php if(!common\models\Tools::isLeader(Yii::$app->user->identity->id, $model->agent) && !$permission['isAdmin']): ?>
		<div class="hide">
			<?php $co_agent = ($model->co_agent == null) ? '' : join(',', $model->co_agent); ?>
			<?= $form->field($model, 'co_agent[]')->hiddenInput(['value' => $co_agent])->label(''); ?>
		</div>
	<?php endif; ?>

    <?= $form->field($model, 'co_agent')->checkboxList(common\models\Tools::getAgentUserList(), ['unselect' => null, 'itemOptions' => ['disabled' => (!common\models\Tools::isLeader(Yii::$app->user->identity->id, $model->agent) && !$permission['isAdmin'])]]) ?>

    <?= $form->field($model, 'operator')->dropdownList(common\models\Tools::getAgentUserList(), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'stage')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_tour_stage')) ?>

    <?= $form->field($model, 'tour_price', ['labelOptions' => ['class' => 'important-info']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estimated_cost', ['labelOptions' => ['class' => 'important-info']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment', ['labelOptions' => ['class' => 'important-info']])->dropdownList(['Unpaid'=>'Unpaid','Deposit Paid'=>'Deposit Paid','Fully Paid'=>'Fully Paid'], ['prompt' => '--Select--', 'disabled' => !($permission['isAdmin'] || $permission['isAccountant'])]) ?>

    <?= $form->field($model, 'accounting_sales_amount')->textInput(['maxlength' => true, 'disabled' => (!($permission['isAdmin'] || $permission['isAccountant']) && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'accounting_total_cost')->textInput(['maxlength' => true, 'disabled' => (!($permission['isAdmin'] || $permission['isAccountant']) && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'accounting_hotel_flight_train_cost')->textInput(['maxlength' => true,'disabled' => (!($permission['isAdmin'] || $permission['isAccountant']) && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'close')->dropdownList(Yii::$app->params['yes_or_no'], ['disabled' => (!($permission['isAdmin'] || $permission['isAccountant']) && !$model->isNewRecord)]) ?>

    <?php
        $form_types = Yii::$app->params['form_types'];
        unset($form_types[1]);
    ?>
    
    <?= $form->field($model, 'tour_type', ['labelOptions' => ['class' => 'important-info']])->dropdownList($form_types, ['prompt' => '--Select--']) ?>
    
    <?= $form->field($model, 'organization')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '100px',
        'maxHeight' => '150px',
        'replaceDivs' => false,
        'buttons' => []
        ],
    ]) ?>

    <?= $form->field($model, 'vip')->dropdownList(Yii::$app->params['yes_or_no']) ?>

    <?= $form->field($model, 'tour_start_date', ['labelOptions' => ['class' => 'important-info']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_end_date', ['labelOptions' => ['class' => 'important-info']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities', ['labelOptions' => ['class' => 'important-info']])->checkboxList(ArrayHelper::map(common\models\OaCity::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'number_of_travelers', ['labelOptions' => ['class' => 'important-info']])->textInput() ?>

    <?= $form->field($model, 'traveler_info')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '100px',
        'maxHeight' => '150px',
        'replaceDivs' => false,
        'buttons' => []
        ],
    ]) ?>

    <?= $form->field($model, 'group_type')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_group_type'), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'country')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_country'), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'contact', ['labelOptions' => ['class' => 'important-info']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email', ['labelOptions' => ['class' => 'important-info']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_contact_info')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '100px',
        'maxHeight' => '150px',
        'replaceDivs' => false,
        'buttons' => []
        ],
    ]) ?>

    <?= $form->field($model, 'itinerary_quotation_english')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'maxHeight' => '400px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        'buttonsHide' => ['file', 'image'],
        ],
    ]) ?>

    <?= $form->field($model, 'itinerary_quotation_other_language')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'maxHeight' => '400px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        'buttonsHide' => ['file', 'image'],
        ],
    ]) ?>

    <?= $form->field($model, 'task_remind')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'task_remind_date', [
        'template' => '{label} &nbsp;&nbsp;&nbsp;(<a class="bt_clear_item" href="javascript:void(0);">Clear</a>) {input}{error}{hint}'
    ]) ?>

    <?= $form->field($model, 'tour_schedule_note')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'maxHeight' => '400px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        'buttonsHide' => ['file', 'image'],
        ],
    ]) ?>

    <?= $form->field($model, 'note_for_guide')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'maxHeight' => '400px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        'buttonsHide' => ['file', 'image'],
        ],
    ]) ?>

    <?= $form->field($model, 'other_note')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'maxHeight' => '400px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        'buttonsHide' => ['file', 'image'],
        ],
    ]) ?>

    <?= $form->field($model, 'attachment')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'maxHeight' => '400px',
        'replaceDivs' => false,
        'buttons' => ['file']
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
        
        $("#oatour-tour_start_date, #oatour-tour_end_date").change(function()
        {
	        var startDate = $("#oatour-tour_start_date").val();
	        var endDate = $("#oatour-tour_end_date").val();
	        
	        if(startDate !== '' && endDate !== '')
	        {
        		var d1 = new Date(startDate);
				var d2 = new Date(endDate);
			
				(d1 > d2) ? alert("Tour end date can not be earlier than start date!") : '';
			}
		});
        
        $(".bt_clear_item").click(function(){
            $(this).next().val("");
        });
        
        $("#oatour-close").change(function()
        {
	       if($("#oatour-close").val() == 1)
	       {
		   		var tourStage = $("#oatour-stage option:selected").text(),
		       		fulfilled = "Tour Fulfilled",
		       		cancelled = "Canceled";
		       		
		       	if(tourStage.indexOf(fulfilled) == -1 && tourStage.indexOf(cancelled) == -1)
		       	{
			       	alert('Only Fulfilled or Cancelled tours can be closed');
			       	$("#oatour-close").val("0");
		       	}
	       } 
        });
        
        var previousStage;
        
        $("#oatour-stage").on('focus', function()
        {
	        previousStage = this.value;
        }).change(function()
        {
	       if($("#oatour-close").val() == 1)
	       {
		   		var tourStage = $("#oatour-stage option:selected").text(),
		       		fulfilled = "Tour Fulfilled",
		       		cancelled = "Canceled";
		       		
		       	if(tourStage.indexOf(fulfilled) == -1 && tourStage.indexOf(cancelled) == -1)
		       	{
			       	alert('Only Fulfilled or Cancelled tours can be closed');
			       	$("#oatour-stage").val(previousStage);
		       	}
	       } 
        });
    });
JS;
$this->registerJs($js);
?>