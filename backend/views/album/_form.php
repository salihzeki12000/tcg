<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\UploadedFiles;
use common\models\Cities;

/* @var $this yii\web\View */
/* @var $model common\models\Album */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url_id')->textInput(['readonly' => (Yii::$app->language != Yii::$app->sourceLanguage),'maxlength' => true]) ?>

    <?= Html::activeHiddenInput($model, 'type', array('value'=>$type)) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->dropdownList(ArrayHelper::map(Cities::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'priority')->textInput(['type' => 'number', 'maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropdownList(Yii::$app->params['dis_status']) ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <?php 
        if ($model->pic_s) {
            echo "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 's') . "' width='200px' /></a>";
        }
    ?>

    <?php 
        if (!$model->isNewRecord) {
    ?>
    <?php //= $form->field($model, 'images')->widget(FileInput::classname(),
        // ['options' => ['multiple' => true,],
        //  'pluginOptions' => [
        //         'uploadAsync' => true,
        //         'minFileCount' => 1,
        //         'maxFileCount' => 10,
        //         'initialPreviewAsData' => true,
        //         'initialPreviewFileType' => 'image',
        //         // 预览的文件
        //         'initialPreview' => $p1,
        //         // 需要展示的图片设置，比如图片的宽度等
        //         'initialPreviewConfig' => $p2,
        //         'overwriteInitial' => false,
        //         'uploadUrl' => Url::toRoute(['/uploaded-files/async-files']),
        //         'uploadExtraData' => [
        //             'name' => $model->name,
        //             'cid'  => $model->id,
        //             'type' => BIZ_TYPE_ALBUM,
        //         ],
        //         'fileActionSettings' => [
        //             // 设置具体图片的查看属性为false,默认为true
        //             'showZoom' => false,
        //             // 设置具体图片的上传属性为true,默认为true
        //             'showUpload' => true,
        //             // 设置具体图片的移除属性为true,默认为true
        //             'showRemove' => true,
        //         ]
        //     ],
        // ]);
    ?>

    <?= $form->field($model, 'overview')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '350px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rec_type')->checkboxList(Yii::$app->params['rec_type']) ?>

    <!-- <?//= $form->field($model, 'status')->textInput() ?> -->

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Next') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= (Yii::$app->language==Yii::$app->sourceLanguage) ?'': Html::Label(Yii::$app->params['language_name'][Yii::$app->language], '', ['class'=>'text text-danger language-hint']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
