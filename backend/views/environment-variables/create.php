<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EnvironmentVariables */

$this->title = Yii::t('app', 'Create Environment Variables');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Environment Variables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="environment-variables-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
