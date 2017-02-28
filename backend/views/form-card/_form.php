<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FormCard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-card-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropdownList(Yii::$app->params['card_status']) ?>

    <?= $form->field($model, 'travel_agent')->dropDownList(\common\models\Tools::getFormTravelAgents(), ['prompt' => '']) ?>

    <?= $form->field($model, 'note')->textarea(['rows'=>3]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
