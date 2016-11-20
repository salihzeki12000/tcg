<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UploadedFiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uploaded-files-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <!-- <?//= $form->field($model, 'org_name')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'image')->fileInput() ?>
    <!-- <?//= $form->field($model, 'path')->textInput(['maxlength' => true]) ?> -->

    <!-- <?//= $form->field($model, 'create_time')->textInput() ?> -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
