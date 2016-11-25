<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TourSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'themes') ?>

    <?php // echo $form->field($model, 'cities') ?>

    <?php // echo $form->field($model, 'cities_count') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'tour_length') ?>

    <?php // echo $form->field($model, 'exp_num') ?>

    <?php // echo $form->field($model, 'price_cny') ?>

    <?php // echo $form->field($model, 'price_usd') ?>

    <?php // echo $form->field($model, 'overview') ?>

    <?php // echo $form->field($model, 'best_season') ?>

    <?php // echo $form->field($model, 'pic_map') ?>

    <?php // echo $form->field($model, 'pic_title') ?>

    <?php // echo $form->field($model, 'inclusion') ?>

    <?php // echo $form->field($model, 'exclusion') ?>

    <?php // echo $form->field($model, 'tips') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'link_tour') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
