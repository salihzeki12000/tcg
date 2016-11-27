<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Cities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- <?//= $form->field($model, 'status')->textInput() ?> -->
    <?= $form->field($model, 'status')->dropdownList(Yii::$app->params['dis_status']) ?>

    <!-- <?//= $form->field($model, 'pic_s')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'image')->fileInput() ?>
    <?php 
        if ($model->pic_s) {
            echo "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 's') . "' width='200px' /></a>";
        }
    ?>

    <?php if (!$model->isNewRecord) { ?>

    <?= $form->field($model, 'images')->widget(FileInput::classname(),
        ['options' => ['multiple' => true,],
         'pluginOptions' => [
                'uploadAsync' => true,
                'minFileCount' => 1,
                'maxFileCount' => 10,
                'initialPreviewAsData' => true,
                'initialPreviewFileType' => 'image',
                // 预览的文件
                'initialPreview' => $p1,
                // 需要展示的图片设置，比如图片的宽度等
                'initialPreviewConfig' => $p2,
                'overwriteInitial' => false,
                'uploadUrl' => Url::toRoute(['/uploaded-files/async-files']),
                'uploadExtraData' => [
                    'name' => $model->name,
                    'cid'  => $model->id,
                    'type' => Yii::$app->params['biz_type']['cities'],
                ],
                'fileActionSettings' => [
                    // 设置具体图片的查看属性为false,默认为true
                    'showZoom' => false,
                    // 设置具体图片的上传属性为true,默认为true
                    'showUpload' => true,
                    // 设置具体图片的移除属性为true,默认为true
                    'showRemove' => true,
                ]
            ],
        ]);
    ?>


    <?= $form->field($model, 'introduction')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '350px',
        ],
    ]) ?>

    <?= $form->field($model, 'food')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '350px',
        ],
    ]) ?>

    <?= $form->field($model, 'rec_type')->checkboxList(Yii::$app->params['rec_type']) ?>

    <?= $form->field($model, 'vr')->textInput(['maxlength' => true]) ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Next') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
