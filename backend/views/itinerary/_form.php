<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UploadedFiles;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Itinerary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itinerary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        if ($model->tour_id) {
    ?>
        <?= Html::activeHiddenInput($model,'tour_id') ?>
        <div class="form-group">
        <label class="control-label">Tour Name</label>
        <div><?= $tour_info['name'] ?></div>
        </div>
    <?php
        } else {
    ?>
    <?= $form->field($model, 'tour_id')->textInput() ?>
    <?php } ?>
    
    <?= $form->field($model, 'day')->textInput() ?>

    <?= $form->field($model, 'cities_name')->textInput(['maxlength' => true]) ?>

    <?php 
        if (!$model->isNewRecord) {
    ?>

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
                    'name' => $model->cities_name,
                    'cid'  => $model->id,
                    'type' => Yii::$app->params['biz_type']['itinerary'],
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

    <?= $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '300px',
        ],
    ]) ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Next') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if(!$model->isNewRecord) {?>
            <?= Html::submitButton(Yii::t('app', 'Save and add Next'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'add_next', 'value'=>'1']) ?>
        <?php } ?>
        <?php 
        if ($model->tour_id) {
        ?>
        <a href="<?= Url::toRoute(['tour/update', 'id'=>$model->tour_id]) ?>"><?= Yii::t('app', 'Back to Tour') ?></a>
        <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
