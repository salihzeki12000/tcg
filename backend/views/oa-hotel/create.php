<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaHotel */

$this->title = Yii::t('app', 'Create Hotel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-hotel-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
