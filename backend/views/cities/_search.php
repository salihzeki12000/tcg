<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CitiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'status') ?>

    <?//= $form->field($model, 'pic_s') ?>

    <?//= $form->field($model, 'pic_l') ?>

    <?php // echo $form->field($model, 'introduction') ?>

    <?php // echo $form->field($model, 'food') ?>

    <?php // echo $form->field($model, 'rec_type') ?>

    <?php // echo $form->field($model, 'vr') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
