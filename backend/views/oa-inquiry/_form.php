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

<?php 
$username = \Yii::$app->user->username;
?>

<div class="oa-inquiry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inquiry_source')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_inquiry_source'), ['prompt' => '--Select--', 'disabled' => (!$permission['isAdmin'])]) ?>

    <?= $form->field($model, 'language', ['labelOptions' => ['class' => 'important-info ']])->dropdownList(common\models\Tools::getEnvironmentVariable('oa_language'), ['prompt' => '--Select--', 'disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'agent', ['labelOptions' => ['class' => 'important-info']])->dropdownList(common\models\Tools::getAgentUserList(), ['prompt' => '--Select--', 'disabled' => (!$permission['isAdmin'] && !$model->isNewRecord)]) ?>

    <?= $form->field($model, 'co_agent')->dropdownList(common\models\Tools::getAgentUserList(), ['prompt' => '--Select--']) ?>

	<?php
	$disable = !$model->isNewRecord && !$permission['isAdmin'] && !$permission['isAccountant'];
    ?>
    <?= $form->field($model, 'inquiry_status')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_inquiry_status'), ['options' => [
	    	5 => ['disabled' => $disable ],
	    	6 => ['disabled' => $disable ],
	    	7 => ['disabled' => $disable ],
	    ]]) ?>

    <?= $form->field($model, 'estimated_cny_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'probability')->dropdownList(['Normal'=>'Normal', 'High'=>'High']) ?>

    <?= $form->field($model, 'close')->dropdownList(Yii::$app->params['yes_or_no']) ?>

    <?= $form->field($model, 'close_report')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '100px',
        'replaceDivs' => false,
        'buttons' => []
        ],
    ]) ?>

    <?php
        $form_types = Yii::$app->params['form_types'];
        unset($form_types[1]);
    ?>
    
    <?= $form->field($model, 'tour_type', ['labelOptions' => ['class' => 'important-info']])->dropdownList($form_types, ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'organization')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '100px',
        'replaceDivs' => false,
        'buttons' => []
        ],
    ]) ?>
    
    <?= $form->field($model, 'priority')->dropdownList(['Normal'=>'Normal', 'High'=>'High']) ?>

    <?= $form->field($model, 'tour_start_date', ['labelOptions' => ['class' => 'important-info']]) ?>

    <?= $form->field($model, 'tour_end_date', [
        'template' => '{label} &nbsp;&nbsp;&nbsp;(<a class="bt_clear_item" href="javascript:void(0);">Clear</a>) {input}{error}{hint}'
    ]) ?>

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

    <?= $form->field($model, 'contact', ['labelOptions' => ['class' => 'important-info']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email', ['labelOptions' => ['class' => 'important-info']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_contact_info')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '100px',
        'replaceDivs' => false,
        'buttons' => []
        ],
    ]) ?>

    <?= $form->field($model, 'task_remind')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'task_remind_date', [
        'template' => '{label} &nbsp;&nbsp;&nbsp;(<a class="bt_clear_item" href="javascript:void(0);">Clear</a>) {input}{error}{hint}'
    ]) ?>

    <?= $form->field($model, 'follow_up_record')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        'buttonsHide' => ['file', 'image'],
        ],
    ]) ?>

    <?= $form->field($model, 'tour_schedule_note')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        'buttonsHide' => ['file', 'image'],
        ],
    ]) ?>

    <?= $form->field($model, 'other_note')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
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

    <?php if($permission['isAdmin'] || ($model->isNewRecord && $permission['isAgent'])) { ?>
        <?= $form->field($model, 'original_inquiry', ['labelOptions' => ['class' => 'important-info']])->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'minHeight' => '250px',
			'maxHeight' => '400px',
            'replaceDivs' => false,
            'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
			'buttonsHide' => ['file', 'image'],
			'editable' => 'false'
            ],
        ]) ?>
    <?php } else { ?>
        <div class="form-group field-oainquiry-original_inquiry">
            <label class="control-label" for="oainquiry-original_inquiry">Original Inquiry</label>
            	<div class="view-long">
	            	<?= $model->original_inquiry?>
	            </div>
        </div>
    <?php } ?>

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
        $("#oainquiry-tour_start_date, #oainquiry-tour_end_date, #oainquiry-task_remind_date").datepicker({ format: 'yyyy-mm-dd' });
        
        $("#oainquiry-tour_start_date, #oainquiry-tour_end_date, #oainquiry-task_remind_date").attr("readonly","readonly");
        
        $(".btn.btn-primary").click(function(e){
	        var inquiryStatus = $("#oainquiry-inquiry_status option:selected").text(),
	        	closeReport = $("#oainquiry-close_report").val(),
	        	closed = $("#oainquiry-close").val(),
		       	booked = "Booked",
	       		lost = "Lost",
	       		bad = "Bad",
	       		duplicate = "Bad - Duplicate";
	       		
	       	if(inquiryStatus == duplicate && closeReport == '')
	       	{
			    e.preventDefault();
		       	alert('This inquiry is a duplicate. Please note the ID of the duplicate inquiry in the "Close Report" field.');
	       	}
	       	else if((inquiryStatus.indexOf(lost) != -1 || inquiryStatus.indexOf(bad) != -1) && closed == 0)
	       	{
			    e.preventDefault();
		       	alert('Inquiry Status is "Lost" or "Bad". Please close this inquiry before saving.');
	       	}
		   	else if(inquiryStatus.indexOf(booked) != -1 && closed == 0)
		    {
			    e.preventDefault();
			   	alert('Inquiry Status is "Booked". Please close this inquiry before saving.');
		    }
		    else if(inquiryStatus.indexOf(booked) != -1 && closed == 0)
		    {
			    e.preventDefault();
			   	alert('Inquiry Status is "Booked". Please close this inquiry before saving.');
		    }
        });
        
        $(".bt_clear_item").click(function(){
        	$(this).next().val("");
        });
        
        $("#oainquiry-close").change(function()
        {
	       if($("#oainquiry-close").val() == 1)
	       {
		   		var inquiryStatus = $("#oainquiry-inquiry_status option:selected").text(),
		       		booked = "Booked",
		       		lost = "Lost",
		       		bad = "Bad";
		       		
		       	if(inquiryStatus.indexOf(booked) == -1 && inquiryStatus.indexOf(lost) == -1 && inquiryStatus.indexOf(bad) == -1)
		       	{
			       	alert('Only Booked or Lost or Bad inquiries can be closed.');
			       	$("#oainquiry-close").val("0");
		       	}
	       } 
        });
        
        var previousStatus;
        
        $("#oainquiry-inquiry_status").on('focus', function()
        {
	        previousStatus = this.value;
        }).change(function()
        {
	       if($("#oainquiry-close").val() == 1)
	       {
		   		var inquiryStatus = $("#oainquiry-inquiry_status option:selected").text(),
		       		booked = "Booked",
		       		lost = "Lost",
		       		bad = "Bad";

		       	if(inquiryStatus.indexOf(booked) == -1 && inquiryStatus.indexOf(lost) == -1 && inquiryStatus.indexOf(bad) == -1)
		       	{
			       	alert('Only Booked or Lost or Bad inquiries can be closed.');
			       	$("#oainquiry-inquiry_status").val(previousStatus);
		       	}
	       } 
        });
    });
JS;
$this->registerJs($js);
?>