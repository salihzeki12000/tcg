<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */

$this->title = Yii::t('app', 'Create Inquiries');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inquiries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
