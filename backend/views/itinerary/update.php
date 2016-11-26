<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Itinerary */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Itinerary',
]) . "Day No." . $model->day;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Itineraries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Day No." . $model->day, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="itinerary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tour_info' => $tour_info,
        'p1' => $p1,
        'p2' => $p2,
    ]) ?>

</div>
