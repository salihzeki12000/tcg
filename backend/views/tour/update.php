<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tour',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ucfirst(Yii::$app->controller->id)), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tour-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'p1' => $p1,
        'p2' => $p2,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'type' => $type,
    ]) ?>

</div>
