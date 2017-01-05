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
                <?= $form->field($model, 'card_type')->dropDownList([ 'Visa'=>'Visa','Mastercard'=>'Mastercard','American Express'=>'American Express' ], ['prompt' => 'Select'])->label(false) ?>
            </td>
            <td width="150px" valign="top" align="center">
                <?= Html::img('@web/statics/images/creditcards.jpg', ['alt'=>'creditcards', 'width'=>"100px"]) ?>
            </td>
        </tr>
    </table>

    

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>

    <label class="control-label" for="formcard-name_on_card"><?=Yii::t('app','Name on card')?></label>
    <table width="100%">
        <tr>
            <td valign="top">
                <?= $form->field($model, 'name_on_card')->textInput(['maxlength' => true])->label(false) ?>
            </td>
            <td width="150px" valign="top" align="center">
                <label><input type="checkbox" name="same_as_client" id="same_as_client" value="0"> same as above</label>
            </td>
        </tr>
    </table>

    <?= $form->field($model, 'card_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_security_code')->textInput(['maxlength' => true]) ?>

    <label class="control-label" for="formcard-expiry_month"><?=Yii::t('app','Expiry Date')?></label>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <?= $form->field($model, 'expiry_month')->dropDownList([ '01 Jan'=>'01 Jan','02 Feb'=>'02 Feb','03 Mar'=>'03 Mar','04 Apr'=>'04 Apr','05 May'=>'05 May','06 Jun'=>'06 Jun','07 Jul'=>'07 Jul','08 Aug'=>'08 Aug','09 Sep'=>'09 Sep','10 Oct'=>'10 Oct','11 Nov'=>'11 Nov','12 Dec'=>'12 Dec', ], ['prompt' => 'Month'])->label(false) ?>
            </td>
            <td width="50%" valign="top">
                <?= $form->field($model, 'expiry_year')->dropDownList([ '2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025','2026'=>'2026','2027'=>'2027','2028'=>'2028','2029'=>'2029', ], ['prompt' => 'Year'])->label(false) ?>
            </td>
        </tr>
    </table>    

    <label class="control-label" for="formcard-amount_to_bill"><?=Yii::t('app','Amount to bill')?></label>
    <table width="100%">
        <tr>
            <td valign="top">
                <?= $form->field($model, 'amount_to_bill')->textInput(['maxlength' => true])->label(false) ?>
            </td>
            <td width="150px" valign="top" align="center">
                CNY
            </td>
        </tr>
    </table>

    <?= $form->field($model, 'billing_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_holder_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travel_agent')->textInput(['maxlength' => true]) ?>

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
                if($('#formcard-client_name').val()){
                    $('#formcard-name_on_card').val($('#formcard-client_name').val()).attr("readonly","readonly");
                }
                else{
                    $(this).attr("checked", false);
                }
            }
            else{
                $('#formcard-name_on_card').attr("readonly",false);
            }
        });
    });
JS;
$this->registerJs($js);
?>