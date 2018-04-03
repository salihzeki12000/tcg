<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FormCard */

$this->title = Yii::t('app', 'Create Form Card');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-card-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
