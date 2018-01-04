<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaGuideExpense */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-guide-expense-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tour_id')->textInput() ?>

    <?= $form->field($model, 'guide_id')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'guide_service_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_spendings')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details_spendings')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cash_collect')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

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
        $("#oaguideexpense-start_date, #oaguideexpense-end_date").attr("readonly","readonly").datepicker({ format: 'yyyy-mm-dd' });
    });
JS;
$this->registerJs($js);
?>