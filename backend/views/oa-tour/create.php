<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaTour */

$this->title = Yii::t('app', 'Create Oa Tour');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-tour-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
