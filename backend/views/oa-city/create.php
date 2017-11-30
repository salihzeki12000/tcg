<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaCity */

$this->title = Yii::t('app', 'Create Oa City');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
