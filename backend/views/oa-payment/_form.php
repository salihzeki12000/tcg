<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tour_id')->textInput(['readonly' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'payer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropdownList(['Deposit'=>'Deposit','Balance'=>'Balance','Full Payment'=>'Full Payment']) ?>

    <?= $form->field($model, 'cny_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'due_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_method')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_pay_method')) ?>

    <?= $form->field($model, 'receit_account')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_receit_account')) ?>

    <?= $form->field($model, 'receit_cny_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receit_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cc_note_signing')->dropdownList(['To be Signed'=>'To be Signed','Signed'=>'Signed','No Sign'=>'No Sign']) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

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
        $("#oapayment-due_date, #oapayment-receit_date").attr("readonly","readonly").datepicker({ format: 'yyyy-mm-dd' });
    });
JS;
$this->registerJs($js);
?>