<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaGuideSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-guide-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'rating') ?>

    <?= $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'daily_price') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'agency') ?>

    <?php // echo $form->field($model, 'contact_info') ?>

    <?php // echo $form->field($model, 'identity_bank_info') ?>

    <?php // echo $form->field($model, 'cl_english') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
