<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FormCard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-card-form">

    <?php $form = ActiveForm::begin(); ?>

    <label class="control-label" for="formcard-card_type"><?=Yii::t('app','Card type')?></label>
    <table width="100%">
        <tr>
            <td valign="top">
                <?= $form->field($model, 'card_type')->dropDownList([ 'Visa'=>Yii::t('app','Visa'),'Mastercard'=>Yii::t('app','Mastercard'),'American Express'=>Yii::t('app','American Express'),'JCB'=>Yii::t('app','JCB') ], ['prompt' => Yii::t('app','Select')])->label(false) ?>
            </td>
            <td width="150px" valign="top" align="center">
                <?= Html::img('@web/statics/images/creditcards.jpg', ['alt'=>'creditcards', 'width'=>"100px"]) ?>
            </td>
        </tr>
    </table>

    
    <?= $form->field($model, 'name_on_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_security_code')->textInput(['maxlength' => true]) ?>

    <label class="control-label" for="formcard-expiry_month"><?=Yii::t('app','Expiry Date')?></label>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <?= $form->field($model, 'expiry_month')->dropDownList([ '01 Jan'=>'01 Jan','02 Feb'=>'02 Feb','03 Mar'=>'03 Mar','04 Apr'=>'04 Apr','05 May'=>'05 May','06 Jun'=>'06 Jun','07 Jul'=>'07 Jul','08 Aug'=>'08 Aug','09 Sep'=>'09 Sep','10 Oct'=>'10 Oct','11 Nov'=>'11 Nov','12 Dec'=>'12 Dec', ], ['prompt' => Yii::t('app','Month')])->label(false) ?>
            </td>
            <td width="50%" valign="top">
                <?= $form->field($model, 'expiry_year')->dropDownList([ '2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025','2026'=>'2026','2027'=>'2027','2028'=>'2028','2029'=>'2029', ], ['prompt' => Yii::t('app','Year')])->label(false) ?>
            </td>
        </tr>
    </table>    

    <label class="control-label" for="formcard-amount_to_bill"><?=Yii::t('app','Amount to bill')?></label>
    <table width="100%">
        <tr>
            <td valign="middle" width="50%">
                <?= $form->field($model, 'amount_to_bill')->textInput(['maxlength' => true])->label(false) ?>
            </td>
            <td width="50%" valign="middle" align="left">
                CNY
            </td>
        </tr>
    </table>

    <div class="form-group field-formcard-donation">
        <label class="control-label" style="font-weight: normal;"><input type="checkbox" id='ck_donation' value="50"> <?=Yii::t('app','Donate to {0}Animals Asia{1}', ['<a target="_blank" href="/misc/animals-asia">', '</a>'])?></label>
        <div id="formcard-donation" style="display: none;padding-left: 15px;">
            <label><input type="radio" name="FormCard[donation]" value="50"> 50 CNY </label><br>
            <label><input type="radio" name="FormCard[donation]" value="100"> 100 CNY </label><br>
            <label><input type="radio" name="FormCard[donation]" id="ck_other_donation" value="other_donation"> <?=Yii::t('app','Other amount')?>: </label>
            <label id="lab_other_donation" style="display: none;"><input type="input" name="other_donation" value="" disabled="disabled" style="width:100px"></label>
        </div>

        <div class="help-block"></div>
    </div>

    <label class="control-label" for="formcard-name_on_card"><?=Yii::t('app','Your full name')?></label>
    <table width="100%">
        <tr>
            <td valign="middle" width="50%">
                <?= $form->field($model, 'client_name')->textInput(['maxlength' => true])->label(false) ?>
            </td>
            <td width="50%" valign="middle" align="left">
                <label class="desc-label"><input type="checkbox" name="same_as_client" id="same_as_client" value="0"> <?=Yii::t('app','Name on card') ?></label>
            </td>
        </tr>
    </table>

    <?= $form->field($model, 'billing_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travel_agent')->dropDownList(\common\models\Tools::getFormTravelAgents(), ['prompt' => '']) ?>

    <?= $form->field($model, 'tour_date')->textInput(['maxlength' => true]) ?>

    <div class="form-group bt-submit">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['frontend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['frontend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#formcard-tour_date").attr("readonly","readonly").datepicker({});

        $('#same_as_client').click(function(){
            if(this.checked){
                if($('#formcard-name_on_card').val()){
                    $('#formcard-client_name').val($('#formcard-name_on_card').val()).attr("readonly","readonly");
                }
                else{
                    $(this).attr("checked", false);
                }
            }
            else{
                $('#formcard-client_name').attr("readonly",false);
            }
        });
        $('#ck_donation').click(function(){
            if(this.checked){
                $('#formcard-donation').show().find('input[type=radio]').removeAttr('disabled');
            }
            else{
                $('#formcard-donation').hide().find('input').removeAttr('checked').attr('disabled','disabled');
            }
        });
        $('#formcard-donation input[type=radio]').click(function(){
            if(this.value=='other_donation'){
                $('#lab_other_donation').show().children("input").removeAttr('disabled');
            }
            else{
                $('#lab_other_donation').hide().children("input").attr('disabled','disabled');
            }
        });
        setTimeout(function(){
            if($('#ck_donation').is( ":checked" )){
                $('#formcard-donation').show().find('input[type=radio]').removeAttr('disabled');
                if($('#ck_other_donation').is( ":checked" )){
                    $('#lab_other_donation').show().children("input").removeAttr('disabled');
                }
                else{
                    $('#lab_other_donation').hide().children("input").attr('disabled','disabled');
                }
            }
            else{
                $('#formcard-donation').hide().find('input').removeAttr('checked').attr('disabled','disabled');
            }
        }, 2000);
    });
JS;
$this->registerJs($js);
?>