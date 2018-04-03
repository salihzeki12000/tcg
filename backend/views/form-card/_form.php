<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FormCard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-card-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropdownList(Yii::$app->params['card_status']) ?>

    <?= $form->field($model, 'travel_agent')->dropDownList(\common\models\Tools::getFormTravelAgents(), ['prompt' => '']) ?>

	<?php $notes = \common\models\Tools::getEnvironmentVariable('credit_card_note'); ?>

	<div class="form-group temp-note">
		<label class="control-label" for="temp-note">Note</label>
		<?= Html::dropDownList('temp-note', null, $notes, ['prompt' => '', 'id' => 'temp-note', 'class' => 'form-control']); ?>
	</div>
    
    <div class="form-group custom-note" style="display: none">
    	<?= Html::textInput('custom_note', null, ['id' => 'custom-note', 'class' => 'form-control']); ?>
	</div>
	
    <?= Html::textInput('FormCard[note]', $model->note, ['id' => 'note', 'class' => 'form-control', 'type' => 'hidden']); ?>
    
    <?php if(!empty($model->note)): ?>
    <div class="form-group">
    	<label class="control-label">Current note:</label> <?= $model->note ?>
	</div>
	<?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
	$(function () {
	    $("#temp-note").change(function(e){
	        var note = $("#temp-note option:selected").text();
	        if(note == 'Other')
	        {
		        $(".custom-note").show();
	        }
	        else
	        {
	        	$("#note").val(note);
		        $(".custom-note").hide();
		        $("#custom-note").val('');
		    }
	    });
	    
	    $("#custom-note").keyup(function(e){
	        var note = $("#custom-note").val();
	        $("#note").val(note);
	    });
	});
JS;
$this->registerJs($js);
?>