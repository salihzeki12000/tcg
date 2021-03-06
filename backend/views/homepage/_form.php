<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Homepage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="homepage-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= Html::activeHiddenInput($model, 'type', array('value'=>$type)) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <?php 
        if ($model->pic_s) {
            echo "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 's') . "' width='200px' /></a>";
        }
    ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'priority')->textInput(['type' => 'number', 'maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropdownList(Yii::$app->params['dis_status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= (Yii::$app->language==Yii::$app->sourceLanguage) ?'': Html::Label(Yii::$app->params['language_name'][Yii::$app->language], '', ['class'=>'text text-danger language-hint']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
