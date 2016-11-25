<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'themes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities_count')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'tour_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exp_num')->textInput() ?>

    <?= $form->field($model, 'price_cny')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_usd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overview')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'best_season')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic_map')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inclusion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'exclusion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tips')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_tour')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
