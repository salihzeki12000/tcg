<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaHotel */

$this->title = Yii::t('app', 'Create Oa Hotel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Hotels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-hotel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
