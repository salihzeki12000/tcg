<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\Cities;
use common\models\UploadedFiles;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'type', array('value'=>$type)) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?php if ($type == TOUR_TYPE_GROUP) { ?>
        <?= $form->field($model, 'begin_date')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'end_date')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'other_dates')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'prices_detail')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'minHeight' => '250px',
            'replaceDivs' => false,
            'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
            ],
        ]) ?>
    <?php } ?>

    <?= $form->field($model, 'status')->dropdownList(Yii::$app->params['dis_status']) ?>

    <?= $form->field($model, 'themes')->checkboxList(Yii::$app->params['tour_themes']) ?>

    <?= $form->field($model, 'rec_type')->checkboxList(Yii::$app->params['rec_type']) ?>

    <?= $form->field($model, 'cities')->checkboxList(ArrayHelper::map(Cities::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'tour_length')->textInput(['maxlength' => true]) ?>

    <?php if (!$model->isNewRecord) { ?>

    <?= $form->field($model, 'display_cities')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities_count')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <?php 
        if ($model->pic_title) {
            echo "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_title, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_title, 's') . "' width='200px' /></a>";
        }
    ?>

    <?= $form->field($model, 'priority')->textInput(['type' => 'number', 'maxlength' => true]) ?>


    <?= $form->field($model, 'exp_num')->textInput() ?>

    <?= $form->field($model, 'best_season')->checkboxList(Yii::$app->params['months']) ?>

    <?= $form->field($model, 'price_cny')->textInput(['maxlength' => true]) ?>

    <!-- <?//= $form->field($model, 'price_usd')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'map_image')->fileInput() ?>
    <?php 
        if ($model->pic_map) {
            echo "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_map, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_map, 's') . "' width='200px' /></a>";
        }
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
                    'name' => $model->name,
                    'cid'  => $model->id,
                    'type' => BIZ_TYPE_TOUR,
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

    <?= $form->field($model, 'overview')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '250px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <!-- <?//= $form->field($model, 'pic_map')->textInput(['maxlength' => true]) ?> -->

    <!-- <?//= $form->field($model, 'pic_title')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'inclusion')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '200px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'exclusion')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '200px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'tips')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '200px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <div class="form-group">
    <label class="control-label">Itinerary</label>
    <div id="itinerary_list">
        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'day',
                    'cities_name',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                return Url::to(['itinerary/update', 'id'=>$model->id]);
                            }
                            if ($action === 'delete') {
                                return Url::to(['itinerary/delete', 'id'=>$model->id]);
                            }
                        },
                    ],
                ],
            ]); ?>
    </div>
    <?= (Yii::$app->language != Yii::$app->sourceLanguage) ? '' : Html::button(Yii::t('app', 'Add Itinerary Item'), ['class' => 'btn btn-primary', 'onclick'=>'window.location=\''.Url::to(['itinerary/create', 'tour_id'=>$model->id]).'\';']) ?>
    </div>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_tour')->textInput(['maxlength' => true]) ?>

    
    <!-- <?//= $form->field($model, 'create_time')->textInput() ?> -->

    <!-- <?//= $form->field($model, 'update_time')->textInput() ?> -->

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Next') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= (Yii::$app->language==Yii::$app->sourceLanguage) ?'': Html::Label(Yii::$app->params['language_name'][Yii::$app->language], '', ['class'=>'text text-danger language-hint']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['backend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['backend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#tour-begin_date, #tour-end_date").attr("readonly","readonly").datepicker({ format: 'yyyy-mm-dd' });
    });
JS;
$this->registerJs($js);
?>