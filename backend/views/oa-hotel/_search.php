<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OaHotelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oa-hotel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'city_id') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'tripadvisor_link') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'rooms_prices') ?>

    <?php // echo $form->field($model, 'contact_person_info') ?>

    <?php // echo $form->field($model, 'bank_info') ?>

    <?php // echo $form->field($model, 'cl_english') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
