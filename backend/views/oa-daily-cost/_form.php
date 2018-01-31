<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\OaDailyCost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-daily-cost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(common\models\Tools::getDailyCostTypes(), ['id' => 'oadailycost-type', 'class'=>'input-large form-control', 'prompt' => '--Select--']); ?>
    
    <?= $form->field($model, 'sub_type')->widget(DepDrop::classname(), [
    'options' => ['id' => 'oadailycost-sub_type', 'class' => 'input-large form-control'],
    'data' => [$model->sub_type => '' ],
    'pluginOptions' => [
        'initialize' => true,
        'depends' => ['oadailycost-type'],
        'placeholder' => '--Select--',
        'url' => Url::to(['/oa-daily-cost/subcat'])
    ]
]);
    ?>

    <?= $form->field($model, 'amount')->textInput() ?>
    
    <?= $form->field($model, 'pay_status')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_pay_status')) ?>

    <?= $form->field($model, 'pay_date')->textInput(['maxlength' => true]) ?>

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
        $("#oadailycost-pay_date").datepicker({ format: 'yyyy-mm-dd' }); 
    });
JS;
$this->registerJs($js);
?>