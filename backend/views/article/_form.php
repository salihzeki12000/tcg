<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= Html::activeHiddenInput($model, 'type', array('value'=>$type)) ?>

    <?php if ($type == ARTICLE_TYPE_FAQ) {?>
    <?= $form->field($model, 'sub_type')->dropdownList(Yii::$app->params['faq_type']) ?>
    <?php } ?>

    <?= $form->field($model, 'priority')->dropdownList([0,1,2,3,4,5,6,7,8,9]) ?>

    <?php if ($type == ARTICLE_TYPE_ARTICLE) {?>
    <?= $form->field($model, 'image')->fileInput() ?>
    <?php 
        if ($model->pic_s) {
            echo "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 's') . "' width='200px' /></a>";
        }
    ?>
    <?php } ?>

    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'minHeight' => '350px',
        'replaceDivs' => false,
        'plugins' => ['fontcolor','fontfamily', 'fontsize', /*'imagemanager'*/],
        ],
    ]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropdownList(Yii::$app->params['dis_status']) ?>

    <!-- <?//= $form->field($model, 'create_time')->textInput() ?> -->

    <!-- <?//= $form->field($model, 'update_time')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
