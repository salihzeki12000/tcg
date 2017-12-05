<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\OaBookCost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-book-cost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tour_id')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'updat_time')->textInput() ?>

    <?= $form->field($model, 'creator')->textInput() ?>

    <?= $form->field($model, 'type')->dropdownList(['oa_guide'=>'Guide','oa_hotel'=>'Hotel','oa_agency'=>'Agency','oa_other_cost'=>'Other Cost']) ?>

    <?= $form->field($model, 'fid')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cl_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'need_to_pay')->dropdownList([1=>'Yes', 0=>'No']) ?>

    <?= $form->field($model, 'cny_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'due_date_for_pay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_status')->dropdownList(Yii::$app->params['yes_or_no']) ?>

    <?= $form->field($model, 'pay_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'book_status')->dropdownList(['Need to Book'=>'Need to Book','Booked and Await Pre-Tour Confirm'=>'Booked and Await Pre-Tour Confirm','Pre-Tour Confirmed'=>'Pre-Tour Confirmed']) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
