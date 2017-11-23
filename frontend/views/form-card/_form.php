<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\FormCard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-card-form">
	<hr />
    <?php $form = ActiveForm::begin(['id'=>'form-card-form']) ?>

    <div class="required">
        <label class="control-label" for="formcard-card_type"><?=Yii::t('app','Card type')?></label>
        <table width="100%">
            <tr>
                <td valign="top">
                    <?= $form->field($model, 'card_type')->dropDownList([ 'Visa'=>Yii::t('app','Visa'),'Mastercard'=>Yii::t('app','Mastercard'),'American Express'=>Yii::t('app','American Express')], ['prompt' => Yii::t('app','')])->label(false) ?>
                </td>
                <td width="150px" valign="top" align="center">
                    <?= Html::img('@web/statics/images/creditcards.jpg', ['alt'=>'creditcards', 'width'=>"100px"]) ?>
                </td>
            </tr>
        </table>
    </div>

    
    <?= $form->field($model, 'name_on_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_number')->textInput(['maxlength' => true]) ?>

    <div class="required">
        <label class="control-label" for="formcard-expiry_month"><?=Yii::t('app','Expiry date')?></label>
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
    </div>

    <div class="required">
        <label class="control-label" for="formcard-amount_to_bill"><?=Yii::t('app','Amount to bill')?></label>
        <table width="100%">
            <tr>
                <td width="70px" valign="middle" align="right">
                    <strong>CN¥</strong>
                </td>
                <td valign="middle">
                    <?= $form->field($model, 'amount_to_bill')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app','in Chinese Yuan')])->label(false) ?>
                </td>
            </tr>
        </table>
    </div>

    <div class="required">
        <label class="control-label" for="formcard-name_on_card"><?=Yii::t('app','Your full name')?></label>
        <table width="100%">
            <tr>
                <td valign="middle" width="50%">
                    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true])->label(false) ?>
                </td>
                <td width="50%" valign="middle" align="left">
                    <label class="desc-label"><input type="checkbox" name="same_as_client" id="same_as_client" value="0"> <?=Yii::t('app','Same as name on card') ?></label>
                </td>
            </tr>
        </table>
    </div>

    <?= $form->field($model, 'billing_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travel_agent')->dropDownList(\common\models\Tools::getFormTravelAgents(), ['prompt' => '']) ?>

    <?= $form->field($model, 'tour_date')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-formcard-donation">
        <label class="control-label"><input type="checkbox" id='ck_donation' value="50"> <?=Yii::t('app','Donate to {0}Animals Asia{1}', ['', ''])?></label>
        <div id="formcard-donation">
            <label><input type="radio" name="FormCard[donation]" value="50"> CN¥ 50 </label><br>
            <label><input type="radio" name="FormCard[donation]" value="100"> CN¥ 100 </label><br>
            <label><input type="radio" name="FormCard[donation]" id="ck_other_donation" value="other_donation"> CN¥ </label>
            <label id="lab_other_donation"><input type="input" class="form-control other-donation" name="other_donation" value="" disabled="disabled" placeholder="<?=Yii::t('app','in Chinese Yuan')?>"></label>
        </div>

        <div><?=Yii::t('app', 'The China Guide has partnered with animal welfare organization {0}Animals Asia{1} to give you an easy way to donate to their fantastic cause. If you would like to support Animals Asia in their fight to end barbaric practices like the bear bile trade, you can choose an amount to donate below. Please be aware that the amount you choose to donate will be added to your total bill.', ['<a class="cc-form-animals-asia" href="/misc/animals-asia" target="_blank">', '</a>']) ?></div>
    </div>

    <div  class="form-group field-formcard-policies">
        <div>
            <label class="control-label"><input type="checkbox" id='ck_policies' value="1" name="ck_policies"> <?=Yii::t('app','I have read and agree to the {0}terms of service{1}', ['<a class="cc-form-terms-of-service" href="'.Url::toRoute(['about-us/company-policies']).'" target="_blank">', '</a>'])?></label>
            <div class="help-block"></div>
        </div>
    </div>

    <div class="form-group bt-submit">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    var form_msg_required = "<?=Yii::t('app','Required')?>";
</script>
<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['frontend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['frontend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#formcard-tour_date").attr("readonly","readonly").datepicker({});

        $('#form-card-form').yiiActiveForm('add', {
            id: 'ck_policies',
            name: 'ck_policies',
            container: '.field-formcard-policies',
            input: '#ck_policies',
            error: '.help-block',
            validate:  function (attribute, value, messages, deferred, form) {
                yii.validation.required(value, messages, {message: form_msg_required});
            }
        });

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
                $('#lab_other_donation').children("input").removeAttr('disabled');
            }
            else{
                $('#lab_other_donation').children("input").attr('disabled','disabled');
            }
        });
        setTimeout(function(){
            if($('#ck_donation').is( ":checked" )){
                $('#formcard-donation').show().find('input[type=radio]').removeAttr('disabled');
                if($('#ck_other_donation').is( ":checked" )){
                    $('#lab_other_donation').children("input").removeAttr('disabled');
                }
                else{
                    $('#lab_other_donation').children("input").attr('disabled','disabled');
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