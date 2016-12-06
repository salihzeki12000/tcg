<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Homepage */

$this->title = Yii::t('app', 'Create ' . ucfirst(Yii::$app->controller->id));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ucfirst(Yii::$app->controller->id)), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homepage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type'  => $type,
    ]) ?>

</div>
