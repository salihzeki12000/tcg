<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\OaBookCost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-book-cost-form">
    <input type="hidden" id="hid_oabookcost_tour_id" value="<?=$model->tour_id?>" />
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->radioList(Yii::$app->params['oa_book_cost_type'], ['itemOptions' => ['disabled' => !$model->isNewRecord]]) ?>

    <?php if (!empty($model->type)) { ?>

    <?= $form->field($model, 'tour_id')->textInput(['readonly' => true]) ?>

    <?php if ($model->type == OA_BOOK_COST_TYPE_GUIDE) { ?>
        <?= $form->field($model, 'fid')->dropdownList(ArrayHelper::map(common\models\OaGuide::find()->all(), 'id', 'name'), ['disabled' => !$model->isNewRecord]) ?>
    <?php } else if ($model->type == OA_BOOK_COST_TYPE_HOTEL) { ?>
        <?= $form->field($model, 'fid')->dropdownList(ArrayHelper::map(common\models\OaHotel::find()->all(), 'id', 'name'), ['disabled' => !$model->isNewRecord]) ?>
    <?php } else if ($model->type == OA_BOOK_COST_TYPE_AGENCY) { ?>
        <?= $form->field($model, 'fid')->dropdownList(ArrayHelper::map(common\models\OaAgency::find()->all(), 'id', 'name'), ['disabled' => !$model->isNewRecord]) ?>
    <?php } else if ($model->type == OA_BOOK_COST_TYPE_OTHER) { ?>
        <?= $form->field($model, 'fid')->dropdownList(ArrayHelper::map(common\models\OaOtherCost::find()->all(), 'id', 'name'), ['disabled' => !$model->isNewRecord]) ?>
    <?php } ?>

    <?php if (!$model->isNewRecord) { ?>

    <?= $form->field($model, 'start_date', [
        'template' => '{label} &nbsp;&nbsp;&nbsp;(<a class="bt_clear_item" href="javascript:void(0);">Clear</a>) {input}{error}{hint}'
        ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_date', [
        'template' => '{label} &nbsp;&nbsp;&nbsp;(<a class="bt_clear_item" href="javascript:void(0);">Clear</a>) {input}{error}{hint}'
        ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_status')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_book_status'), ['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'book_date', [
        'template' => '{label} &nbsp;&nbsp;&nbsp;(<a class="bt_clear_item" href="javascript:void(0);">Clear</a>) {input}{error}{hint}'
        ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cl_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'need_to_pay')->dropdownList(Yii::$app->params['yes_or_no']) ?>

    <div class="need_to_pay_yes_show" style="<?php if($model->need_to_pay!=1) { ?>display:none;<?php } ?>">

    <?= $form->field($model, 'cny_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'due_date_for_pay', [
        'template' => '{label} &nbsp;&nbsp;&nbsp;(<a class="bt_clear_item" href="javascript:void(0);">Clear</a>) {input}{error}{hint}'
        ])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'pay_status')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_pay_status'), ['disabled' => !$permission['canAdd']]) ?>

	<?php if($permission['canAdd']): $template = '{label} &nbsp;&nbsp;&nbsp;(<a class="bt_clear_item" href="javascript:void(0);">Clear</a>) {input}{error}{hint}'; else: $template = '{label} {input}{error}{hint}'; endif;?>

    <?= $form->field($model, 'pay_date', [
        'template' => $template
		])->textInput(['maxlength' => true, 'disabled' => !$permission['canAdd']]) ?>

    <?= $form->field($model, 'pay_amount')->textInput(['maxlength' => true, 'disabled' => !$permission['canAdd']]) ?>

    <?= $form->field($model, 'pay_method')->dropdownList(common\models\Tools::getEnvironmentVariable('oa_pay_method'), ['prompt' => '--Select--', 'disabled' => !$permission['canAdd']]) ?>

    <?= $form->field($model, 'transaction_note')->textarea(['rows' => 6, 'disabled' => !$permission['canAdd']]) ?>

    </div>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Next') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['backend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['backend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#oabookcost-start_date, #oabookcost-end_date, #oabookcost-due_date_for_pay, #oabookcost-pay_date, #oabookcost-book_date").attr("readonly","readonly").datepicker({ format: 'yyyy-mm-dd' });
        $('input[type=radio][name=\"OaBookCost[type]\"]').change(function() {
            var tourId = $('#oabookcost-tour_id').val();
            if(tourId=='' || tourId==undefined){
                tourId = $('#hid_oabookcost_tour_id').val();
            }
            window.location.href='?type='+this.value+'&tour_id='+tourId;
        });
        $('#oabookcost-need_to_pay').change(function() {
            if (this.value==1){
                $(".need_to_pay_yes_show").show();
            }
            else{
                $(".need_to_pay_yes_show").hide();
            }
        });
        $(".bt_clear_item").click(function(){
        	$(this).next().val("");
        });
    });
JS;
$this->registerJs($js);
?>