<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); $model->password_hash='' ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'password_hash')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList([ User::STATUS_ACTIVE => Yii::t('app','ACTIVE'), User::STATUS_DELETED => Yii::t('app','INVALID') ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
