<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaAgency */

$this->title = Yii::t('app', 'Create Oa Agency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Agencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-agency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
